<?php

class Langswitcher_plugin_Model extends Model {

	public function returnLanguages() {
		return Apace::$ac['languages'];
	}

}