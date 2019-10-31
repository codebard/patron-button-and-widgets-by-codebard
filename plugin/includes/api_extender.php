<?php

if ( class_exists( 'Patreon_API' ) ) {
	
	class api_extender extends Patreon_API {
		
		// For now duplicates and uses v1 and v2 versions of get_json because the originals in the Patreon_API are private. The duplicated functions can go away when get_json in Patreon_API is made public
			
		public function fetch_goals( ) {
				
			$api_version = get_option( 'patreon-installation-api-version', false );

			if ( $api_version AND $api_version == '2' ) {
				
				return $this->__get_json( "campaigns?include=goals&fields[goal]=amount_cents,title,description,created_at,reached_at,completed_percentage" );
			}
			else {
				return $this->__get_json( "current_user/campaigns?include=goals&fields[goal]=amount_cents,title,description,created_at,reached_at,completed_percentage" );
			}
		}
		
	}

}