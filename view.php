<?php

/**
This is the core class of the PicoMVC PHP framework.
Instanciate this class whenever you want to hold a
model. Simply set the fields of View to some values.

When you're finished, call render() and the template will be rendered.

Inside the phtml files you can access all fields of the
View object with $this->field_name.
*/
class View {
	/**
	Render a template. If no template is given, render
	the layout template.

	Templates should be located in view/ and should have the
	.phtml extension. A template 'users/login' will render
	'view/users/login.phtml'.

	@param template name of the template to render
	*/
	function render($template = 'layout') {
		include 'view/'.$template.'.phtml';
	}
}
