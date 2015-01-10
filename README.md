PicoMVC PHP Framework
================

PicoMVC is a minimalistic PHP framework intended for PHP programmers who want to write clean code without being forced to adjust their brains to a big framework which restricts them.

Components
------------

PicoMVC only consists of a templating engine. The engine is completely object oriented and renders a surrounding template as well as nested template snippets.

Directory Structure
------------

- <tt>\*.php</tt> all controllers you want to write. Take index.php as a reference.
- <tt>view.php</tt> the template engine
- <tt>db.php</tt> the database engine
- <tt>conf.php.dist</tt> the default config (copy to conf.php in deployment)
- <tt>js/</tt> for your javascript
- <tt>css/</tt> for your style sheets
- <tt>img/</tt> for your images
- <tt>view/</tt> your template snippets
- <tt>view/layout.phtml</tt> the layout of all pages

Usage
---------

You basically write controllers as php files that require 'view.php', do some logic and then instanciate a <tt>View</tt> object, fill in the fields and call <tt>render()</tt>. Set <tt>View-&gt;template</tt> to a script in <tt>view/</tt> and implement all rendering routines there while the logic stays in the controllers.

Telling the view to render <tt>users/edit</tt> means it will render the file <tt>view/users/edit.phtml</tt>. Insert your HTML code into that file and access the <tt>$this</tt> object from PHP in order to access the fields set by the controller. Render inner views by calling <tt>$this-&gt;render('viewname')</tt> or creating a new <tt>View</tt> object and calling <tt>render()</tt>. The second version is better since it encapsulates data e.g. for loops.

If you want to use database support, create a new file, require 'db.php', create a class that inherits from DB and override performUpdates(). Then, whenever you need the database, create an instance of your new class. Use MyClass::getInstance(). Put all database related functions into your class.

Getting Started
---------------

Just clone the git repository into a folder and start adding controllers and views.

<tt>git clone https://github.com/carli2/picomvc-skeleton</tt>

Star and watch this repository if you like the idea of a lightweight clean framework for small and big projects.
