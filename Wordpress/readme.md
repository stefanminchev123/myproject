## Deploying new themes:

### When using parent+child bundle be sure that style.css in the child theme has proper headers. Example:

```
/*
 Theme Name:   ldg
 Description:  Established in 1987, Central London Estate Agents LDG have become a leading force in the West End property market.
 Author:       Cobweb Software
 Author URI:   http://www.cobweb.biz
 Template:     cobwebprogressive (parent theme folder name)
 Version:      1.0.0
 Theme:        #231f20, #2e2a2b, #7b7979, #fafafa, #28d03c
*/
```

__Note__:
* Themes optionally should contain original source files for future reference
* Plugins are not required to do so.

## Using themes:

1. Copy your theme and in _/wp-content/themes/_
2. Rename child folder to the project name.
3. Search & Replace all instances of __cpchild__ with your project name (lowercase, low dash delimitted only)
4. Change theme favicon and screenshot
5. (Optional) Add site/theme description in _style.css_