Redovisning
====================================
 
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
 
