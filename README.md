# london-news
London News website with weather api capabilities: https://dev-london-news.pantheonsite.io/

## Login details for CMS
Login at https://dev-london-news.pantheonsite.io/user

### Editor
Username: editor

Password: ZAlX65*nAt1f

### Administrator
Username: admin

Password: sOAu*A1V6zD1

## CMS set up
- Article content type
	- Use contrib pargraphs module to create new elements which can be rearranged on the page
	- Add new postcode field to set where the article is based

- News view
	- New view displaying all news articles sorted by most recent
	- Postcode filter added
	- Set to be homepage of London News site

- Roles
	- New editor role created

## Custom modules
- Custom descriptions
	- Adds extra description to Article title field for editor roles

- Weather
	- Adds weather block to articles (displaying weather for area you're reading about)
	- Adds weather block with postcode look up form, can be placed anywhere on site
	- Uses https://openweathermap.org free current weather api

## Custom theme
- London News theme
	- Uses Gulp and sass for assets directory
	- Uses html.twig templates to set up sementic html
