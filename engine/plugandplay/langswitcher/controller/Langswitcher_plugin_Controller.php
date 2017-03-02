<?php

class Langswitcher_plugin_Controller extends Controller {

	public function init() {
		$this->setViewData('languages', Apace::loadModel('langswitcher_plugin_')->returnLanguages());
	}

	public function switchlang() {

		$lang = strtolower(Apace::getRouter()->getParam(1));
		Apace::redirect(Apace::baseUrl().$lang);

	}

}