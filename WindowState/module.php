<?php
    // Klassendefinition
    class WindowState extends IPSModule {

        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();

            $this->RegisterPropertyInteger("Reed1ID", 0);
            $this->RegisterPropertyInteger("Reed2ID", 0);
            $this->RegisterPropertyInteger("WindowOpenMode", 0);
            $this->RegisterPropertyInteger("WindowTiltMode", 0);

            IPS_CreateVariableProfile("SIT.WindowState", 1);
            IPS_SetVariableProfileValues("SIT.WindowState", 0, 2, 0);
            IPS_SetVariableProfileDigits("SIT.WindowState", 0);
            IPS_SetVariableProfileAssociation("SIT.WindowState", 0, "geschlossen", "Window", -1);
            IPS_SetVariableProfileAssociation("SIT.WindowState", 1, "gekippt", "Window", -1);
            IPS_SetVariableProfileAssociation("SIT.WindowState", 2, "geöffnet", "Window", -1);

            $this->RegisterVariableInteger("WindowState", "WindowState", "SIT.WindowState", 1);

        }

        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
            // Diese Zeile nicht löschen
            parent::ApplyChanges();

            $this->RegisterMessage($this->ReadPropertyInteger("Reed1ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed2ID"), 10603 /* VM_UPDATE */);
          
        }

        public function MessageSink($TimeStamp, $SenderID, $Message, $Data) {
            $this->UpdateWindowState();
        }

        /**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        * ABC_MeineErsteEigeneFunktion($id);
        *
        */
        private function UpdateWindowState() {
            $Reed1 = GetValue($this->ReadPropertyInteger("Reed1ID"));
            $Reed2 = GetValue($this->ReadPropertyInteger("Reed2ID"));

            $WindowOpenMode = $this->ReadPropertyInteger("WindowOpenMode");
            $WindowTiltMode = $this->ReadPropertyInteger("WindowTiltMode");

            $this->SendDebug("WindowState", "WindowOpenMode: " . $WindowOpenMode, 0);
            $this->SendDebug("WindowState", "WindowTiltMode: " . $WindowTiltMode, 0);
            $this->SendDebug("WindowState", "Reed 1: " . (int)$Reed1, 0);
            $this->SendDebug("WindowState", "Reed 2: " . (int)$Reed2, 0);

            $WindowState = 0;

            switch ($WindowOpenMode){
                case 0:
                    if (!$Reed1 && !$Reed2){
                        $WindowState = 2;
                    }
                break;

                case 1:
                    if (!$Reed1 && $Reed2){
                        $WindowState = 2;
                    }
                break;

                case 2:
                    if ($Reed1 && !$Reed2){
                        $WindowState = 2;
                    }
                break;

                case 3:
                    if ($Reed1 && $Reed2){
                        $WindowState = 2;
                    }
                break;
            }

            switch ($WindowTiltMode){
                case 0:
                    if (!$Reed1 && !$Reed2){
                        $WindowState = 1;
                    }
                break;

                case 1:
                    if (!$Reed1 && $Reed2){
                        $WindowState = 1;
                    }
                break;

                case 2:
                    if ($Reed1 && !$Reed2){
                        $WindowState = 1;
                    }
                break;

                case 3:
                    if ($Reed1 && $Reed2){
                        $WindowState = 1;
                    }
                break;
            }
            SetValue($this->GetIDForIdent("WindowState"), $WindowState);
            $this->SendDebug("WindowState", "Window State: " . (int)$WindowState, 0);
        }
    }
