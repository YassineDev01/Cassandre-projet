# Dictionnaire des données

---

## Référentiels

### Table : Role

Représente les rôles applicatifs attribués aux utilisateurs.

| Attribut | Type   | Description                                            |
| -------- | ------ | ------------------------------------------------------ |
| id       | int    | Identifiant unique du rôle                             |
| code     | string | Code du rôle (`ADMIN`, `AUDITOR`, `EXAMINER`, `STAFF`) |
| libelle  | string | Libellé descriptif du rôle                             |

---

### Table : User

Représente un utilisateur du système.

| Attribut   | Type   | Description                         |
| ---------- | ------ | ----------------------------------- |
| id         | int    | Identifiant unique de l’utilisateur |
| email      | string | Adresse email de connexion          |
| nomAffiche | string | Nom affiché dans l’application      |
| motDePasse | string | Mot de passe (hashé)                |
| actif      | bool   | Indique si le compte est actif      |

---

### Table : Client

Représente une entreprise cliente.

| Attribut         | Type    | Description                  |
| ---------------- | ------- | ---------------------------- |
| id               | int     | Identifiant unique du client |
| raisonSociale    | string  | Nom de l’entreprise          |
| emailContact     | string? | Email de contact principal   |
| telephoneContact | string? | Téléphone de contact         |

---

### Table : Audit

Représente une mission d’audit réalisée pour un client.

| Attribut    | Type   | Description                                          |
| ----------- | ------ | ---------------------------------------------------- |
| id          | int    | Identifiant unique de l’audit                        |
| titre       | string | Titre de la mission                                  |
| statut      | string | État de l’audit (`BROUILLON`, `EN_COURS`, `TERMINE`) |
| dateDebut   | date?  | Date de début de l’audit                             |
| dateFin     | date?  | Date de fin de l’audit                               |
| description | text?  | Description détaillée                                |

---

### Table : Auditor

Entité d’association entre un utilisateur et un audit.

| Attribut      | Type   | Description                                   |
| ------------- | ------ | --------------------------------------------- |
| id            | int    | Identifiant unique                            |
| roleDansAudit | string | Rôle dans l’audit (`AUDITEUR`, `RESPONSABLE`) |

---

### Table : DocumentAudit

Représente un document lié à un audit.

| Attribut     | Type     | Description                                                       |
| ------------ | -------- | ----------------------------------------------------------------- |
| id           | int      | Identifiant unique du document                                    |
| type         | string   | Type de document (`PIECE`, `LETTRE_MISSION`, `MANDAT`, `RAPPORT`) |
| nomOriginal  | string   | Nom original du fichier                                           |
| nomStockage  | string   | Nom du fichier stocké                                             |
| chemin       | string   | Chemin de stockage                                                |
| mimeType     | string   | Type MIME                                                         |
| tailleOctets | int      | Taille du fichier en octets                                       |
| creeLe       | datetime | Date de création                                                  |

---

### Table : Facture

Représente une facture émise pour un client.

| Attribut     | Type    | Description                                         |
| ------------ | ------- | --------------------------------------------------- |
| id           | int     | Identifiant unique de la facture                    |
| numero       | string  | Numéro de facture                                   |
| statut       | string  | Statut (`BROUILLON`, `EMPRISE`, `PAYEE`, `ANNULEE`) |
| dateEmission | date    | Date d’émission                                     |
| totalHT      | decimal | Montant total hors taxes                            |
| totalTTC     | decimal | Montant total toutes taxes comprises                |
| pdfChemin    | string? | Chemin du PDF                                       |

---

### Table : LigneFacture `Optionelle`

Détail d’une facture.

| Attribut       | Type    | Description           |
| -------------- | ------- | --------------------- |
| id             | int     | Identifiant unique    |
| libelle        | string  | Désignation           |
| quantite       | int     | Quantité              |
| prixUnitaireHT | decimal | Prix unitaire HT      |
| tauxTVA        | decimal | Taux de TVA           |
| totalLigneTTC  | decimal | Total TTC de la ligne |

---

## Relations entre entités

| Entité source | Cardinalité  | Entité cible  | Description                                         |
| ------------- | ------------ | ------------- | --------------------------------------------------- |
| Role          | 1 → 0..\*    | User          | Un rôle peut être attribué à plusieurs utilisateurs |
| Client        | 1 → 0..\*    | Audit         | Un client peut avoir plusieurs audits               |
| Audit         | 1 → 0..\*    | Auditor       | Un audit implique plusieurs auditeurs               |
| User          | 1 → 0..\*    | Auditor       | Un utilisateur peut participer à plusieurs audits   |
| Audit         | 1 → 0..\*    | DocumentAudit | Un audit contient plusieurs documents               |
| User          | 1 → 0..\*    | DocumentAudit | Un utilisateur dépose des documents                 |
| Client        | 1 → 0..\*    | Facture       | Un client reçoit des factures                       |
| Audit         | 0..1 → 0..\* | Facture       | Une facture peut être liée à un audit               |
| Facture       | 1 → 1..\*    | LigneFacture  | Une facture contient une ou plusieurs lignes        |

---
