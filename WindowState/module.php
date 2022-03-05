<?php
    // Klassendefinition
    class WindowGroupState extends IPSModule {

        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();

            $this->RegisterPropertyInteger("Reed1ID", 0);
            $this->RegisterPropertyInteger("Reed2ID", 0);
            $this->RegisterPropertyInteger("Reed3ID", 0);
            $this->RegisterPropertyInteger("Reed4ID", 0);
            $this->RegisterPropertyInteger("Reed5ID", 0);
            $this->RegisterPropertyInteger("Reed6ID", 0);
            
            $this->RegisterPropertyInteger("WindowOpenMode", 0);
            $Profile = "WGS.WindowGroup";
            if (!IPS_VariableProfileExists($Profile)){
                IPS_CreateVariableProfile($Profile, 1);
                IPS_SetVariableProfileValues($Profile, 0, 2, 0);
                IPS_SetVariableProfileDigits($Profile, 0);
                IPS_SetVariableProfileAssociation($Profile, 0, "geschlossen", "Window", -1);
                IPS_SetVariableProfileAssociation($Profile, 1, "geöffnet", "Window", -1);
            }

            $this->RegisterVariableInteger("WindowGroup", "WindowGroup", "WGS.WindowGroup", 1);

        }

        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
            // Diese Zeile nicht löschen
            parent::ApplyChanges();

            $this->RegisterMessage($this->ReadPropertyInteger("Reed1ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed2ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed3ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed4ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed5ID"), 10603 /* VM_UPDATE */);
            $this->RegisterMessage($this->ReadPropertyInteger("Reed6ID"), 10603 /* VM_UPDATE */);

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
            $Reed3 = GetValue($this->ReadPropertyInteger("Reed3ID"));
            $Reed4 = GetValue($this->ReadPropertyInteger("Reed4ID"));
            $Reed5 = GetValue($this->ReadPropertyInteger("Reed5ID"));
            $Reed6 = GetValue($this->ReadPropertyInteger("Reed6ID"));
            $WindowOpenMode = $this->ReadPropertyInteger("WindowOpenMode");
            
            $this->SendDebug("WindowGroup", "WindowOpenMode: " . $WindowOpenMode, 0);
            $this->SendDebug("WindowGroup", "Reed 1: " . (int)$Reed1, 0);
            $this->SendDebug("WindowGroup", "Reed 2: " . (int)$Reed2, 0);
            $this->SendDebug("WindowGroup", "Reed 3: " . (int)$Reed3, 0);
            $this->SendDebug("WindowGroup", "Reed 4: " . (int)$Reed4, 0);
            $this->SendDebug("WindowGroup", "Reed 5: " . (int)$Reed5, 0);
            $this->SendDebug("WindowGroup", "Reed 6: " . (int)$Reed6, 0);
            $WindowState = 0;
            if ($Reed1 != 0 || $Reed2 != 0 || $Reed3 != 0|| $Reed4 != 0 || $Reed5 != 0 || $Reed6 != 0){
                $WindowGroup = 1;
            }
            SetValue($this->GetIDForIdent("WindowGroup"), $WindowState);
            $this->SendDebug("WindowGroup", "Window Group: " . (int)$WindowState, 0);
        }
    }
