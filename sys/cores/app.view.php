<?php

class AppView extends LvcView
{
	public function requireCss($cssFile)
	{
		$this->controller->requireCss($cssFile);
	}
	
	public function requireJs($jsFile)
	{
		$this->controller->requireJs($jsFile);
	}
	
	public function requireJsInHead($jsFile)
	{
		$this->controller->requireJsInHead($jsFile);
	}
}

?>