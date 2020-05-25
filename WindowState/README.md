# WindowState

Dieses Modul stellt den Zustand von Fenstern oder Türen, welche mit zwei Magnetkontakten ausgestattet sind, in IP-Symcon in einer Variable dar.

### Inhaltverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)

### 1. Funktionsumfang

* Zustände der Magnetkontakte für geöffnet und gekippt konfigurierbar
* Fensterstatus wird bei Änderung der Magentkontakte automatisch aktualisiert

### 2. Voraussetzungen

- IP-Symcon ab Version 5.x
- Zwei Magnetkontakte pro Fenster. Ein Magnetkontakt zeigt an, wenn das Fenster geöffnet ist. Ein weiterer Magnetkontakt zeigt an, wenn das Fenster geschlossen ist. Die Magnetkontakte müssen vom Typ Boolean in IP-Symcon vorhanden sein.

### 3. Software-Installation

Über das Modul-Control folgende URL hinzufügen.  
`git://github.com/DerStandart/WindowState`  

### 4. Einrichten der Instanzen in IP-Symcon

- Unter "Instanz hinzufügen" ist das 'WindowState'-Modul unter dem Hersteller 'Schrader IT-Beratung' aufgeführt.  
- Auswahl der IDs der Magnetkontakte.
- Zustände der Magnetkontakte für "Fenster geöffnet" und "Fenster geschlossen" einstellen.

__Konfigurationsseite__:

Name          | Beschreibung
------------- | ---------------------------------
Magnetkontakt 1 | Hier die ID von Magnetkontakt 1 auswählen.
Magnetkontakt 2 | Hier die ID von Magnetkontakt 2 auswählen.
Fenster geöffnet | Hier die Zustände der Magnetkontakte für "Fenster geöffnet" eintragen.
Fenster gekippt | Hier die Zustände der Magnetkontakte für "Fenster gekippt" eintragen.


### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

Name                    | Typ       | Beschreibung
----------------------- | --------- | ----------------
WindowState          | Integer   | Zeigt den Zustand des Fensters an. 0 = geschlossen, 1 = gekippt, 2 = geöffnet

Es wird das Variablenprofil SIT.WindowState angelegt.
