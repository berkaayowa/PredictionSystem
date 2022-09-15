<?php
/**
 * Created by PhpStorm.
 * User: berka
 * Date: 2018/03/21
 * Time: 17:28
 */

namespace Resource;


use BerkaPhp\Helper\Language;

class Label
{
    private static $Fr = [
        'General'=>[
            'User' => 'Client',
            'Username' => 'Nom du client',
            'GroupUser' => 'Nom du company',
            'GroupUserCode' => 'Code du company',
            'LblEditGroupUserCode' => "Modification d'information du company",
            'SiteUrl' => "Le lien du site",
            'GroupUserDescription' => 'La description du company',
            'Save' => 'Sauvegarder',
            'Settings' => 'Reglage',
            'Theme' => 'Theme du company',
            'GeneralInfo' => "Les' information general",
            'Description' => 'Description',
            'Transaction' => 'Transaction',
            'Home' => 'Acuelle',
            'Branch' => 'Branche',
            'Edit'=>'Modifier',
            'Delete'=>'Supprimer',
            'View'=>'Regarder',
            'SMSNotification'=>'Notification par SMS',
            'EmailNotification'=>'Notification par email',
            'MobileAccess'=>"Access Mobile",
            'WebAccess'=>"Access Web",
            'IsActive'=>"Active",
            'NewBranch'=>"Nouvelle Branche",
            'UpdateBranch' =>'Modification De La Branch',
            'Users' =>'Utilisateur',
            'Reports' => 'Rapports',
            'Company' => 'Compagnie',
            'Back' => 'Retour',
            'NewTransaction' => 'Nouvelle transaction',
            'NewCompany' => 'Nouvelle Compagnie',
            'Companies' => 'Compagnies',
            'Greet' => 'Salut',
            'Transactions' =>'Transactions',
            'YES' => 'Oui',
            'NO' => 'Non',
            'ExistingCustomer' => 'Client existant',
            'SenderDetails' => 'Détails du expéditeur',
            'ReceiverDetails' => 'Détails du destinataire',
            'TransactionDetails' => 'Détails du transfer',
            'TransactionFound' => "Transaction trouve'e avec succès",
            'NoTransactionFound'=>"Aucune transaction trouve'",
            'SearchingTransaction'=>"Entre de cherche' la transation...",
            'SearchTransaction'=>"Cherche' la transation",
            'ApproveTransaction'=>"Approuver cette transaction",
            'SenderName'=>"Nom de l'expéditeur",
            'ReceiverName'=>"Nom du destinataire",
            'EmailAddress'=>'Address Email',
            'Name'=>'Nom',
            'Surname'=>'Nom de famille',
            'CellNumber'=>"Numéro de téléphone",
            'Amount'=>'Montant',
            'Currency'=>'Devise',
            'CreatedBy'=>"Créé par",
            'HoldTransaction'=>'Tenir cette transaction',
            'CancelTransaction'=>'Annuler cette transaction',
            'PaymentMethod'=>'Mode de paiement',
            'TransactionDate'=>'Date de la transaction',
            'TransactionMethod'=>'Transféré via',
            'Comment'=>'Commentaire',
            'Approve'=>'Approver',
            'Hold'=>'Tenir',
            'Cancel'=>'Canceler',
            'ApprovingTransaction'=>"En train d'approuver la transaction",
            'CancelingTransaction'=>"En train d'annuler la transaction",
            'HoldingTransaction'=>"En train de tenir la transaction",
            'AddingUser'=>"En train de sauvegarder le fiche'",
            'UpdatingUser'=>"En train de modifier le fiche'",
            'PhysicalAddress'=>'Adresse physique',
            'CanReceive'=>'Peut recevoir',
            'CanSend'=>'Peut envoyer',
            'CanLogin'=>'Peux se connecter',
            'UserSettings'=>"Paramètres utilisateur",
            'UserDetails'=>"Détails de l'utilisateur",
            'List'=>'liste',
            'IsVerified'=>"Est vérifié",
            'UserRole'=>"Rôle d'utilisateur",
            'FullName'=>"nom complet",
            'LastUpdated'=>"Dernière mise à jour",
            'Authorisation'=>'Autorisation',
            'ApproveConfirmationMessage'=>"Etes-vous sûr de vouloir confirmer cette transaction?",
            'ApproveConfirmationTitle'=>"Confirmation de la transaction",
            'CancelConfirmationMessage'=>"Etes-vous sûr de vouloir annuler cette transaction?",
            'CancelConfirmationTitle'=>"Annulation de la transaction",
            'HoldConfirmationMessage'=>"Etes-vous sûr de vouloir tenir cette transaction?",
            'HoldConfirmationTitle'=>"Tenir la transaction",
            'TransactionProcessedAlready'=>"Cette transaction a ete' deja recupere'",
            'NotYet'=>'Pas encore',
            'Yes'=>'Oui',
            'Processed'=>"Traité"
        ],
        'Error' =>[
            'AccountNotActivated'=>'Compte non activé, activez votre compte en cliquant sur le lien envoyé à votre adresse email',
            'AccountSuspended'=>'Compte suspendu, veuillez contacter le support',
            'InvalidLogin'=>'Les informations de connexion ne sont pas valides, réessayez',
            'Saving'=>"Erreur, impossible de sauvegarder cet fiche' , réessayez",
            'NoTransactionFound'=>"Aucune transaction trouve'e",
            'ResetPasswordEmailed'=>"Le lien de réinitialisation n'a pas pu vous être envoyé par e-mail, réessayez",
            'SaveRestPasswordCode'=>"Opp! le système n'a pas pu enregistrer votre code de mot de passe de repos, veuillez réessayer",
            'EmailNotFound' => "Oop nous n'avons pas pu trouver l'adresse email donnée",
            'OperationNotAllowed' => "Oop vous n'êtes pas autorisé à effectuer l'opération demandée",
            'StatusNotFound'=>"Oop! erreur , le status not pas ete' trouve'"
        ],
        'Success' =>[
            'Saving'=>"Fiche'enregistré avec succès",
            'TransactionFound'=>"Transaction trouve'e avec succès",
            'ResetPasswordEmailed'=>'Le lien Réinitialiser vous a été envoyé par e-mail avec succès'
        ],
        'Code'=>[
            'APV'=>"Approuvé",
            'CNL'=>"Annulé",
            'PDN'=>'En attendant',
            'HLD'=>'Teni'
        ]

    ];

    private static $En = [
        'General'=>[
            'User' => 'User',
            'Username' => 'Username',
            'GroupUser' => 'Company name',
            'GroupUserCode' => 'Company Code',
            'LblEditGroupUserCode' => "Editing company information",
            'SiteUrl' => "Site url",
            'GroupUserDescription' => 'Company Description',
            'Save' => 'Save',
            'Settings' => 'Settings',
            'Theme' => 'Theme',
            'GeneralInfo' => "General information",
            'Description' => 'Description',
            'Transaction' => 'Transaction',
            'Home' => 'Home',
            'Branch' => 'Branch',
            'Edit'=>'Edit',
            'Delete'=>'Delete',
            'View'=>'View',
            'SMSNotification'=>'SMS Notification',
            'EmailNotification'=>'Email Notification',
            'MobileAccess'=>"Mobile Access",
            'WebAccess'=>"Web Access",
            'IsActive'=>"Active",
            'NewBranch'=>"New Branch",
            'UpdateBranch' =>'Update Branch',
            'Users' =>'Users',
            'Reports' => 'Reports',
            'Company' => 'Company',
            'Back' => 'Back',
            'NewTransaction' => 'New Transaction',
            'NewCompany' => 'New company',
            'Companies' => 'Companies',
            'Greet' => 'Hi',
            'Transactions' =>'Transactions',
            'YES' => 'Yes',
            'NO' => 'No',
            'ExistingCustomer' => 'Existing Customer',
            'SenderDetails' => 'Sender Details',
            'ReceiverDetails' => 'Receiver Details',
            'TransactionDetails' => 'Transaction Details',
            'TransactionFound' => 'Transaction found',
            'NoTransactionFound'=>'No transaction found',
            'SearchingTransaction'=>"Searching transaction...",
            'SearchTransaction'=>"Search transaction",
            'ApproveTransaction'=>"Approve ths transaction",
            'SenderName'=>"Sender Name",
            'ReceiverName'=>"Receiver Name",
            'HoldTransaction'=>'Hold this transaction',
            'CancelTransaction'=>'Cancel this transaction',
            'EmailAddress'=>'Email Address',
            'CreatedBy'=>"Created By",
            'PaymentMethod'=>'Payment Method',
            'TransactionDate'=>'Transaction Date',
            'TransactionMethod'=>'Transacted via',
            'Comment'=>'Comment',
            'Approve'=>'Approve',
            'Hold'=>'Hold',
            'Cancel'=>'Cancel',
            'ApprovingTransaction'=>'Approving transaction',
            'CancelingTransaction'=>'Canceling transaction',
            'HoldingTransaction'=>'Holding transaction',
            'AddingUser'=>"Adding user",
            'UpdatingUser'=>"Updating user",
            'CellNumber'=>'Cell Phone',
            'PhysicalAddress'=>'Physical Address',
            'CanReceive'=>'Can Receive',
            'CanSend'=>'Can Send',
            'CanLogin'=>'Can Login',
            'IsDeleted'=>"Is Deleted",
            'UserSettings'=>"User Settings",
            'UserDetails'=>"User Details",
            'List'=>'List',
            'IsVerified'=>"Is Verified",
            'UserRole'=>"Role",
            'FullName'=>"Full name",
            'LastUpdated'=>'Last updated',
            'Authorisation'=>'Authorisation',
            'ApproveConfirmationMessage'=>"Are you sure, you want to approve this transaction ?",
            'ApproveConfirmationTitle'=>"Transaction Approval",
            'CancelConfirmationMessage'=>"Are you sure, you want to cancel this transaction ?",
            'CancelConfirmationTitle'=>"Transaction Cancellation",
            'HoldConfirmationMessage'=>"Are you sure, you want to hold this transaction ?",
            'HoldConfirmationTitle'=>"Holding Transaction",
            'TransactionProcessedAlready'=>"This transaction has been processed already",
            'NotYet'=>'Not Yet',
            'Yes'=>'Yes',
            'Processed'=>"Processed"

        ],
        'Error' =>[
            'AccountNotActivated'=>'Account not activated, activate your account by click the link sent to your email-address ',
            'AccountSuspended'=>'Account suspended, please contact support',
            'InvalidLogin'=>'Invalid login details, try again',
            'Saving'=>"Opp! error the system could not save this record, try again ",
            'NoTransactionFound'=>'No transaction found',
            'ResetPasswordEmailed'=>'Reset link could not be successfully emailed to you, try again',
            'SaveRestPasswordCode'=>'Opp! the system could not save your rest password code, please try again',
            'EmailNotFound' => 'Oop we could not find the given email address',
            'OperationNotAllowed' => 'Oop you are not allowed to perform the operation requested',
            'StatusNotFound'=>'Oop! error , Status no found'

        ],
        'Success' =>[
            'Saving'=>"Successfully saved record",
            'TransactionFound'=>'Transaction found',
            'ResetPasswordEmailed'=>'Reset link has been successfully emailed to you'
        ],
        'Code'=>[
            'APV'=>'Approved',
            'CNL'=>'Cancelled',
            'PDN'=>'Pending',
            'HLD'=>'Hold'
        ]

    ];

    private static function get ($lang){

        $Resources = [
            'EN' =>  self::$En,
            'FR' =>  self::$Fr
        ];

        return $Resources[$lang];
    }

    public static function General($key, $language = "") {
        if(empty($language)) {
            if(array_key_exists($key, self::get(Language::getLanguage())['General'])) {
                return self::get(Language::getLanguage())['General'][$key];
            }
        }
        return $key;

    }

    public static function Code($key, $language = "") {
        if(empty($language)) {
            if(array_key_exists($key, self::get(Language::getLanguage())['Code'])) {
                return self::get(Language::getLanguage())['Code'][$key];
            }
        }
        return $key;

    }

    public static function Error($key, $language = "") {
        if(empty($language)) {
            if(array_key_exists($key, self::get(Language::getLanguage())['Error'])) {
                return self::get(Language::getLanguage())['Error'][$key];
            }
        }
        return $key;

    }

    public static function Success($key , $language = "") {
        if(empty($language)) {
            if(array_key_exists($key, self::get(Language::getLanguage())['Success'])) {
                return self::get(Language::getLanguage())['Success'][$key];
            }
        }
        return $key;

    }


}