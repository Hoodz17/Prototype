# YFS: Backoffice

Voor het beheren van de users, video's, categorieën, tags en attributen.

## Getting started

1. Maak een checkout van de code.
2. Installeer alle `composer` dependencies voor PHP.
   > `composer install`
3. Installeer alle `nodejs` dependencies voor Codyframe met `npm`.

   > `npm install` of `npm i`

4. Genereer de JavaScript en stylesheets.

   > `npm run compile:static`
   
    of

    > `npm run gulp build`

5. Start de server op met het volgende commando:

   > `npm run server`

   of met

   > `php -S http://localhost:8888 -t public/`

6. Open je browser en ga naar [http://localhost:8888](http://localhost:8888)
7. Happy coding :smile:

*Als `npm` niet gevonden wordt, moet je eerst NodeJS installeren. Daarnaast verifieren zijn dat `npm` op je `$PATH` zit.*

## Codyframe componenten toevoegen

1. Kijk op Codyframe.
2. Zoek naar wat je nodig hebt en download het component. (rechtsboven in de preview pagina)
3. Plaats de desbetreffende (S)CSS en JS bestanden in de mappen: `main/assets/css/components` (voor de styles) en `main/assets/js/components` (voor de JavaScript).
4. Update de `style.css` en `scripts.js` met het onderstaande commando:

   > `npm run compile:static`

5. Commit en push alle changes zodra het werkt.

## Uitrollen / Deployment

1. Alles wat in de release mee moet mergen naar branch `main` en een `git tag` erop toevoegen.
2. Zip aanmaken met de mappen
  - `app/` (alle application 'business' logic)
  - `public/` (voor de CSS, JS, afbeeldingen en overige 'static' bestanden)
  - `vendor/` (overige dependencies en autoloaders)

3. Inloggen op de server (vraag @GINO voor toestemmming)
4. Open WinSCP, en verbind met onze productieomgeving
5. Ga naar de map `public_html/freekieadmin`.
6. De bestaande uitrol verplaatsen naar een map die de laatste uitroldatum heeft
  - check de changed date van de map `app`
  - backup map naam heeft de volgende format YYYYMMDD
7. De **NIEUWE** `app`, `public` en `vendor` mappen uploaden naar de `freekieadmin` map
8. Verifieren dat alle changes er staan en de admin interface werkt naar verwachting.
  - check ook de server messagelog voor PHP warnings errors en exceptions met `tail -f /var/log/messages`
  - ^^^^ hier is ook toestmming voor nodig, vraag @GINO OF @DILO hiervoor.
  - Los de errors warnings op die voorbijkomen.

Verder geen fouten na testen? Mooi! Meld het team dat de laatste uitrol gelukt is.


-----


## TODO

> NOTE: Onderstaande lijst is eeb collectie van wat er nog in moet komen. Lijst is NIET gesorteerd op prioriteit.

- Integratie GUI met Codyhouse Codyframe
- Ticket interface

  - Tonen van openstaande en bestaande issues
  - Replies geven op geopende issues

- Orders
  - Overzicht
  - Billing addressen
    - CRUD?
- Pages
  - CRUD
- Logs
  - Read only
- Temps (voor tijdelijke dingen? @gino)
- Screens
  - CRUD
- Review manager
  - CRUD
- useHasFav (favorite video system)
  - Show user favorites
  - Show user wishlist
- Financials (mutations table)
- Comments manager
  - CRUD
  - Messages
