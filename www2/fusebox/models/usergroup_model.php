<?php

	class Usergroup {
		public $ID = -1;
		public $Name = "";
		public $Description = "";
		public $TicketCats = 0;
		public $Flags = "";
		public $NumUsers = 0;
		public $Deleteable = true;
		
		public function AddTicketCat( $CatID ) {
			$this->TicketCats = $this->TicketCats | pow( 2, $CatID );
			get_instance()->db->query( "UPDATE `usergroups` SET `TicketCats` = {$this->TicketCats} WHERE `ID` = {$this->ID};" );
		}
		
		public function HasTicketCat( $CatID ) {
			return ( $this->TicketCats & pow( 2, $CatID ) );
		}
		
		public function RemoveTicketCat( $CatID ) {
			$this->TicketCats = $this->TicketCats & ~(pow( 2, $CatID ));
			get_instance()->db->query( "UPDATE `usergroups` SET `TicketCats` = {$this->TicketCats} WHERE `ID` = {$this->ID};" );
		}
		
		public function RemovePermission( $PermID ) {
			$this->Flags = get_instance()->better_bitwise->RemoveFlag( $this->Flags, $PermID );
			get_instance()->db->query( "UPDATE `usergroups` SET `Flags` = '{$this->Flags}' WHERE `ID` = {$this->ID};" );
		}
		
		public function GivePermission( $PermID ) {
			$this->Flags = get_instance()->better_bitwise->AddFlag( $this->Flags, $PermID );
			get_instance()->db->query( "UPDATE `usergroups` SET `Flags` = '{$this->Flags}' WHERE `ID` = {$this->ID};" );
		}
		
		public function HasPermission( $PermID ) {
			return get_instance()->better_bitwise->HasFlag( $this->Flags, $PermID );
		}
	}

	class Permission {
		public $ID = -1;
		public $Key = "";
		public $Category = 0;
		
		public function GetName() {
			return lang( "permission_{$this->Key}_title" );
		}
		
		public function GetDesc() {
			return lang( "permission_{$this->Key}_desc" );
		}
	}
	
	class PermissionCat {
		public $ID = -1;
		public $Key = "";
		
		public function GetName() {
			return lang( "permissioncategory_" . $this->Key . "_title" );
		}
	}
	
	class Permissions {
		
		public static $Grabbed = false;
		public static $Categories = array();
		public static $Permissions = array();
		
		static function GetByKey( $Key ) {
			if( Permissions::$Grabbed == false ) Permissions::Grab();
			
			foreach( Permissions::$Permissions as $Perm ) {
				if( $Perm->Key == $Key ) return $Perm;
			}
			
			return false;
		}
		
		static function GetAll() {
			if( Permissions::$Grabbed == false ) Permissions::Grab();
			return Permissions::$Permissions;
		}
		
		static function Grab() {
			Permissions::$Grabbed = true;
			Permissions::$Categories = array();
			Permissions::$Permissions = array();
			
			$PermissionCats = get_instance()->db->query( "SELECT * FROM `permissions_categories`;" );
			$Permissions = get_instance()->db->query( "SELECT * FROM `permissions`;" );
			
			foreach( $PermissionCats->result() as $Row )
			{
				$PermCat = new PermissionCat();
				$PermCat->ID = $Row->ID;
				$PermCat->Key = $Row->Key;
				array_push( Permissions::$Categories, $PermCat );
			}
			
			foreach( $Permissions->result() as $Row )
			{
				$Perm = new Permission();
				$Perm->ID = $Row->ID;
				$Perm->Key = $Row->Key;
				$Perm->Category = $Row->Category;
				array_push( Permissions::$Permissions, $Perm );
			}
		}
		
		static function GetCategories() {
			if( Permissions::$Grabbed == false ) Permissions::Grab();
			return Permissions::$Categories;
		}
	}
	
	class Usergroup_model extends CI_Model {
		
		public $Grabbed = false;
		public $Objects = array();
		
		function GetAll() {
			if( $this->Grabbed == false ) $this->GrabAll();
			return $this->Objects;
		}
		
		function GetByID( $ID ) {
			if( $this->Grabbed == false ) $this->GrabAll();
		
			foreach( $this->Objects as $Obj ) {
				if( $Obj->ID == $ID ) {
					return $Obj;
				}
			}
			
			return false;
		}
		
		function GrabAll() {
			$this->Objects = array();
			$this->Grabbed = true;
			
			$Query = $this->db->query( "SELECT * FROM `usergroups`;" );
			
			foreach( $Query->result() as $Row )
			{
				$Usergroup = new Usergroup();
				$Usergroup->ID = $Row->ID;
				$Usergroup->Name = $Row->Name;
				$Usergroup->Description = $Row->Description;
				$Usergroup->TicketCats = $Row->TicketCats;
				$Usergroup->Flags = $Row->Flags;
				$Usergroup->Deleteable = ( $Row->Deleteable == 1 );
				
				$Query2 = $this->db->query( "SELECT COUNT(*) FROM `users` WHERE `usergroup` = {$Row->ID};" );
				$Row = $Query2->row_array();
				$Usergroup->NumUsers = $Row[ "COUNT(*)" ];
				
				array_push( $this->Objects, $Usergroup );
			}
		}
		
	}

?>