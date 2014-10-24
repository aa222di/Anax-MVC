Redovisning
====================================
 
Kmom03: Grid, FontAwesome och LESS  {#3}
------------------------------------
### Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?
Jag har tidigare byggt en sida men CSS-ramverket Foundation. Detta gjore jag när jag var helt 'grön' så att säga och jag minns att jag tyckte det var alldeles för mycket kod. Jag var inne och ändrade ganska mycket i filerna eftersom de var svåra att skriva över. Jag kan idag tycka det är kul att kika på ramverkenshemsidor och skumma igenom koden men eftersom CSS är något som jag själv tycker om så föredrar jag att skriva min egen kod. Ofta blir koden, förr eller senare, väldigt lång och det kan vara svårt att att skriva 'snygg' CSS. Personligen börjar jag ofta rent och snyggt men med tiden blir koden mer och mer komplex med komplicerade selektorer, jag säger itne att det är bra eller dåligt, men jag strävar alltid efter att med så lite CSS som möjligt åstadkomma det jag vill och ofta går jag tillbaka och ändrar grundstrukturen flera gånger för att se om jag kan uppnå samma resultat men med mindre CSS.
### Vad tycker du om LESS, lessphp och Semantic.gs?
LESS och lessphp var mycket trevligt att bekanta sig med. lessphp fungerade på en gång och är definivt något jag kommer ta med mig i framtida projekt. Jag har länge varit nyfiken på LESS men inte hunnit sätta mig in i det. Jag hade trott att inlärningströskeln skulle vara lite högre, men faktum är att det är så pass likt CSS att jag kunde börja skriva kod på en gång utan att läsa på särskilt mycket i manualer och tutorials.

Jag testade att använda Semantic.gs och tyckte det fungerade bra. Dock har jag länge letat efter det perfekta 'grid':et och tycker mig även sedan ett tag tillbaka ha fastnat för några principer som jag läst om på css-tricks.com. Så efter att ha försökt bygga ett tema med Semantic.gs så bestämda jag mig tillslut för att ta det bästa från css-tricks.com och semantic.gs och skapa en egen hybrid - edengrid. Den stora skillnaden är att jag inte använder margin mellan boxarna utan istället padding. Sedan är 'gutter' alltid 20px vilket jag tycker är bra när man arbetar med widths i procent. Edengrid är något att bygga vidare på, inför dne här uppgiften har jag bara gjort vad jag behövde för att bygga fördigt temat, men ett par push/pull mixins vore något som man skulle kunna bygga in i framtiden.
### Vad tycker du om gridbaserad layout, vertikalt och horisontellt?
Första gången jag arbetat med ett horisontellt grid, allt blev ju bra mycket snyggare måste jag säga. Jag hade stor hjälp av artikeln 'Technical Web Typography: Guidelines and Techniques'.
### Har du några kommentarer om Font Awesome, Bootstrap, Normalize?
Font Awesome var toppen att använda, dock är jag lite av en illustratorfantast också. Men jag ser en bra möjlighet att spara tid och det är givetvis en resurs som är kul att ha med sig. Som jag nämnde ovan är CSS-ramverk en bra inspirationskälla, men jag tycker ofta att det är för mycket kod, skulle vilja bygga ett eget miniramverk en dag att ha som start till alla projekt. Passar bättre för mig som gillar att alltid 'specialbygga' detaljerna till webbsidor. Jag har innan använt reset.css av Meyer. Men tänker nu ge normalize en chans. Svårt att utvärdera innan man skrivit lite fler teman och testat i olika webbläsare.
### Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?
Jag lade ganska myckt krut på att förstå och tänka till kring semantic.gs och edengrid. Något jag tänkte till på var väl just att jag ville kunna i temat växla mellan områden som tänker 100% av fönstervidden och sådana som ligger inom 'contentwidth'. För att lyckas med detta så har jag helt enkelt en .site-content-container som klipps av om flash-2 och -3 används. Men jag försökte faktiskt hålla mig lite tråkig och mest fokusera på att bygga något som sedan skulle vara enkelt att bygga ut i projektet. Jag gjorde dock en liten exempelsida för att visa hur det skulle kunna se ut med text och Font Awesome.
### Antog du utmaningen som extra uppgift?
Jag ville ju så gärna göra denna, men jag känner inte att jag hann bli färdigt med något som jag kan lägga upp på GitHub, dock tänker jag snart ladda upp edengrid för att sedan bygga vidare på det. 
 
Kmom02: Modeller och controllers  {#2}
------------------------------------
Att jobba i composer kändes enkelt på det vis att klasserna automatiskt blir inkluderade tack vare att Anax-MVC tittar efter composer-autoloaders. Däremot har jag svårt att förstå koden som ligger bakom allt, dvs. vad composer exakt gör. Jag kikade runt på deras sida och såg att många paket var specialbyggda för andra MVC-ramverk. Jag laddade ner jimmiw:s 'time_ago'-package som jag hade sett att en klasskompis användt sig av. Paketet var enkelt att använda om man följde instruktionerna från readme-filen.

Jag har fortfarande inte blivit helt klar med hur ramverket utför allt. Eller rättare sagt jag har svårt att följa vilka steg som tas och i vilken ordning. För att arbeta med kommentarerna så användes olika redirects flitigt mellan actions. Detta beredde stora problem för mig eftersom redirecten ofta pekar på baseurl. När jag ville inkludera mina kommentarer på webroot/report så omdirigerades jag till webroot/ varje gång jag tryckte på 'add comment'. Det känns inte helt vattentätt eftersom dispatchen läser routen som 'controller/action/params' i förra delmomentet så kodade vi ju routen på ett annat sätt egentligen eftersom report inte är någon kontroller. Jag hade svårt att se hur man skulle få in mer funktionalitet på en och samma sida utan att routerna krockar.

Jag löste till slut uppgiften genom att lägga till en eventuell route som parameter från index.php i funktionen $this->url->create($route). Dock är jag inte helt nöjd med denna lösningen, tycker det borde finnas ett bättre sätt som gör att appen själv kan känna in att den står på report.

Jag vet inte om jag tycker det fanns några direkta svagheter som så i phpmvc/comment. Snarare kändes inte klasserna färdigbygga. Det fanns inget stöd för validering av inkommande parameterar och den behövdes byggas ut för att hantera edit och remove-one.

Att inkludera gravatar och ett litet javascript gick i alla fall enkelt. Men resten av uppgiften var rejält svår för mig och jag upplever fortfarande att jag har mycket kvar att lära mig om ramverket. Trots att jag upplevde att jag behärskade php ganska väl i slutet på föregående kurs (oophp) så upplever jag nu att jag står på ruta ett igen. Det går mycket tid åt att leta efter verkställande kod och jag stöter ofta på kodnsuttar som jag inte ritkigt förstår meningen med.
 

Kmom01: Me-sidan  {#1}
------------------------------------
 
Jag arbetar i MAMP och skriver i ST2, använder FileZilla för att lägga upp filer på studentservern och surfar i Firefox. Terminalen används för att prata med github.

Ramverk är inget som jag tidgare har bekantat mig med. Allt jag kan om kod och php har jag lärt mig i de två föregående kurserna (htmlphp och oophp). Jag är heller inte bekant med någon av de mer avancerade begreppen som introduceras i detta kursmoment. Allt kändes nytt forutom vissa delar av AnaxMVC som jag kände igen från Anax (oophp). Dock känns det som en naturlig vidareutveckling och det ska bli spännande att få bekanta sig med lite mer avancerad kod nu. 

Jag passade på att göra de extrauppgifter som erbjöds för att försöka få lite mer koll på strukturen i Anax-MVC. Jag kan tänka mig att det med tiden säkert kan vara bra med mycket uppdelning och olika mappar, men såhär i början har det verkligen känts som en labyrint och det har blivit mycket klickande fram och tillbaka för att hitta rätt kodsnuttar. Jag tycker fortfarande sällan jag hittar de bitar som verkligen verkställer koden utan snarare så hittar jag små smulor här och där. Antar att saker och ting klarnar efter hand.

Slutligen forkade jag Anax-MVC på github och lyckades pusha upp mina egna ändringar. Ska bli spännande att få jobba lite med med git också under kursen.
 
