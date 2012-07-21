Setting up the home page
------------------------

1. Create a page called "Home"
2. Assign it the page template "Home Carousel"
3. In the WordPress Admin, go to "Settings > Reading". Under "Front Page Displays", select "A static page". Under "Front page", select your page "Home" from the dropdown menu.
4. Save changes.

Managing the carousel
---------------------

You can manage the home page carousel by going to the home page edit screen and launching the media editor.

1. In the WordPress Admin, go to "Pages" and select "Home".
2. Click the Media icon above the edit screen (it should look like a camera with a musical note next to it). A lightbox will appear.

You can upload new gallery images from the computer using WordPress' upload mechanism. Images will be automatically cropped to fit dimensions (976 x 518).
Make sure to upload big enough images!

To edit and arrange carousel items, click on the "Gallery" tab.

You can drag-and-drop re-order gallery items. When displayed in the carousel, the items from top to bottom will be shown left to right, with the top-most item first.

You can click on an individual item to edit it. Fields:

* Title: this will show up as a tooltip when hovering over the image.
* Description: the text you enter here will show up in the white ribbon of the carousel.
* Carousel URL: if you type in a URL to a page or website, the image will be linked when displayed in the carousel.

After editing, save your changes by clicking "Save all changes" at the bottom.

To theme developers
-------------------

To future developers who are excited to hack on this theme, go for it. Make sure to keep a backup copy before you get hacking. Please use [Github](https://github.com/) to maintain a changelog for the theme, or at the very least, drop the theme folder into a [Dropbox](https://www.dropbox.com) account so a list of file revisions is maintained as you change things.

Here's a list of other resources that are pretty much industry best-practices at the time I write this:

* [_s theme by Automattic](https://github.com/Automattic/_s) is *the* officially sanctioned Automattic WordPress starter theme, so it's bound to use best practices. `_s` is what we based this theme on.
* It's pretty hard to go wrong with [Twitter Bootstrap](http://twitter.github.com/bootstrap) for CSS and JavaScript.
* [HTML5 Boilerplate](http://html5boilerplate.com/) has thought longer and harder about web pages than you or I.

To CSS hackers
--------------

* Please be thoughtful.
* We use [normalize.css](http://necolas.github.com/normalize.css/) to provide
  a solid baseline for CSS development.
* A full suite of grid classes is available. They are based on a modified
  version of [960 grid system](http://960.gs/). Mostly this means I
  replaced `-` with `_` for consistency, and updated the `.clearfix` to
  [Micro Clearfix](http://nicolasgallagher.com/micro-clearfix-hack/).

Adding CSS, JavaScript
----------------------

All JavaScript and CSS should be added via [wp_enqueue_script](http://codex.wordpress.org/Function_Reference/wp_enqueue_script) and
[wp_enqueue_style](http://codex.wordpress.org/Function_Reference/wp_enqueue_style). See `functions.php` for an example of where and how to do this.

Browser Support
---------------

* IE8 with no rounded corners or carousel animations
* IE9+
* Safari (latest)
* Chrome (latest)
* Firefox (latest)
* Opera (latest)