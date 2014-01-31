PicoMVC PHP Framework
================

PicoMVC is a minimalistic PHP framework intended for PHP programmers who want to write clean code without being forced to adjust their brains to a big framework which restricts them.

Components
------------

PicoMVC only consists of a templating engine. The engine is completely object oriented and renders a surrounding template as well as nested template snippets.

Directory Structure
------------

- \*.php all controllers you want to write. Take index.php as a reference.
- view.php the template engine
- js/ for your javascript
- css/ for your style sheets
- img/ for your images
- view/ your template snippets
- view/layout.phtml the layout of all pages

Usage
---------

You basically write controllers as php files that require 'view.php', do some logic and then instanciate a View object, fill in the fields and call render(). Set View-&gt;template to a script in view/ and implement all rendering routines there while the logic stays in the controllers.

PicoMVC is one of the best documented frameworks I ever saw. Every file contains enough comments to have a clear idea how to use the framework properly.
