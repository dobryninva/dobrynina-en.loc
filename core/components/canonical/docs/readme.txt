Canonical Extra for MODX Revolution
=======================================

Author: Bob Ray (https://bobsguides.com)

Documentation: (https://bobsguides.com/canonical-tutorial.html)

Bugs and requests: (https://github.com/BobRay/Canonical/issues)

Questions about using Canonical: (https://community.modx.com)

As of Version 3.0.0-pl, Canonical puts a canonical tag on every page by default, as recommended by SEO experts and reportedly confirmed by Google.

Canonical creates an automatic canonical tag for Symlinks in MODX Revolution, to prevent search engine penalties for duplicate content.

Install with Package Manager and place this tag in the <head> section of all templates (the exclamation point is important):

    [[!Canonical]]

If you don't want a tag on every page, change the `canonical_always` System Setting value to `No`.

See the documentation at https://bobsguides.com/canonical-tutorial.html for more details.
