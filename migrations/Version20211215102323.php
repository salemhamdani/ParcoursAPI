<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215102323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_formation_experience DROP FOREIGN KEY FK_BBD718F046E90E27');
        $this->addSql('ALTER TABLE type_public_experience DROP FOREIGN KEY FK_233349F546E90E27');
        $this->addSql('ALTER TABLE entretien_formateur_theme DROP FOREIGN KEY FK_F502C8E61AF8CDF2');
        $this->addSql('ALTER TABLE type_formation_experience DROP FOREIGN KEY FK_BBD718F0D543922B');
        $this->addSql('ALTER TABLE type_public_experience DROP FOREIGN KEY FK_233349F5172CA81');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE content_template');
        $this->addSql('DROP TABLE content_theme');
        $this->addSql('DROP TABLE content_widget');
        $this->addSql('DROP TABLE entreprise_personal_informations');
        $this->addSql('DROP TABLE entrepriseavelider');
        $this->addSql('DROP TABLE entretien_formateur_theme');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE interview_informations');
        $this->addSql('DROP TABLE partenaire_adresse');
        $this->addSql('DROP TABLE postulant');
        $this->addSql('DROP TABLE prospect');
        $this->addSql('DROP TABLE responsable_formation');
        $this->addSql('DROP TABLE tiers_stage');
        $this->addSql('DROP TABLE type_formation_experience');
        $this->addSql('DROP TABLE type_public_experience');
        $this->addSql('DROP TABLE typeformation');
        $this->addSql('DROP TABLE typepublic');
        $this->addSql('ALTER TABLE codeabsences ADD CONSTRAINT FK_5468F3B05D17678C FOREIGN KEY (financeur_id) REFERENCES financeurs (id)');
        $this->addSql('ALTER TABLE cataloguefront ADD CONSTRAINT FK_8EBD43AE6D6B297 FOREIGN KEY (profil) REFERENCES profil (id)');
        $this->addSql('DROP INDEX idx_c58face2e6d6b297 ON cataloguefront');
        $this->addSql('CREATE INDEX IDX_8EBD43AE6D6B297 ON cataloguefront (profil)');
        $this->addSql('ALTER TABLE contrat ADD receptiondocs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499939F1F5D8F FOREIGN KEY (receptiondocs_id) REFERENCES masterlistelgs (id)');
        $this->addSql('CREATE INDEX IDX_603499939F1F5D8F ON contrat (receptiondocs_id)');
        $this->addSql('ALTER TABLE cv_experience ADD formateurexp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv_experience ADD CONSTRAINT FK_7A66549185E4725E FOREIGN KEY (formateurexp_id) REFERENCES formateurs (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7A66549185E4725E ON cv_experience (formateurexp_id)');
        $this->addSql('ALTER TABLE dossierannexes ADD reunion_pole_emploi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dossierannexes ADD CONSTRAINT FK_328F0D3E7CB1D3E5 FOREIGN KEY (reunion_pole_emploi_id) REFERENCES masterlistelgs (id)');
        $this->addSql('CREATE INDEX IDX_328F0D3E7CB1D3E5 ON dossierannexes (reunion_pole_emploi_id)');
        $this->addSql('ALTER TABLE dossiers CHANGE itempes itempes LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE financements ADD concernefrais TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE financeurs ADD financementopco_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE financeurs ADD CONSTRAINT FK_41B82BA97849EC3D FOREIGN KEY (financementopco_id) REFERENCES masterlistelgs (id)');
        $this->addSql('CREATE INDEX IDX_41B82BA97849EC3D ON financeurs (financementopco_id)');
        $this->addSql('DROP INDEX UNIQ_4B019DDB5E237E06 ON fos_group');
        $this->addSql('ALTER TABLE fos_group DROP name, DROP roles');
        $this->addSql('DROP INDEX UNIQ_957A6479C05FB297 ON fos_user');
        $this->addSql('DROP INDEX UNIQ_957A647992FC23A8 ON fos_user');
        $this->addSql('DROP INDEX UNIQ_957A6479A0D96FBF ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP username, DROP username_canonical, DROP email, DROP email_canonical, DROP enabled, DROP salt, DROP password, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles');
        $this->addSql('ALTER TABLE mailreceptioncandidatures DROP FOREIGN KEY FK_2115229F6E38C0DB');
        $this->addSql('DROP INDEX IDX_2115229F6E38C0DB ON mailreceptioncandidatures');
        $this->addSql('ALTER TABLE mailreceptioncandidatures DROP parcours_id');
        $this->addSql('ALTER TABLE masterlistelgs CHANGE designation designation TINYTEXT DEFAULT NULL, CHANGE valeur valeur TEXT DEFAULT NULL, CHANGE valeur2 valeur2 TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_content_page CHANGE dataCreation dataCreation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE participant CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE tel tel VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE societe CHANGE imagerib imagerib LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_juridique CHANGE dateinscription dateinscription DATETIME NOT NULL, CHANGE datemodification datemodification DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, archive TINYINT(1) NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, creationdate DATETIME DEFAULT NULL, updatedate DATETIME DEFAULT NULL, rang INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, alias VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_template (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, archive TINYINT(1) NOT NULL, creationdate DATE NOT NULL, updatedate DATE DEFAULT NULL, rang INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_theme (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, archive TINYINT(1) NOT NULL, creationdate DATE NOT NULL, updatedate DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_widget (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, archive TINYINT(1) NOT NULL, INDEX IDX_EDCF6E7CC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE entreprise_personal_informations (entreprise_id INT NOT NULL, personal_informations_id INT NOT NULL, INDEX IDX_69E523D14D33B99D (personal_informations_id), INDEX IDX_69E523D1A4AEAFEA (entreprise_id), PRIMARY KEY(entreprise_id, personal_informations_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE entrepriseavelider (id INT AUTO_INCREMENT NOT NULL, raisonSocial VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, qualitede VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, tel VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, courriel VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, siret VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, representepar VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE entretien_formateur_theme (entretien_formateur_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_F502C8E659027487 (theme_id), INDEX IDX_F502C8E61AF8CDF2 (entretien_formateur_id), PRIMARY KEY(entretien_formateur_id, theme_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, poste VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, entreprise VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lieu VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, dateDebut DATE DEFAULT NULL, dateFin DATE DEFAULT NULL, description LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, formationEtat TINYINT(1) DEFAULT NULL, posteStatut TINYINT(1) DEFAULT NULL, INDEX IDX_590C103155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE interview_informations (id INT AUTO_INCREMENT NOT NULL, examinateur_id INT DEFAULT NULL, formateur_id INT DEFAULT NULL, date DATE DEFAULT NULL, commentaire LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, heurs VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, etat TINYINT(1) NOT NULL, lieu VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_FF826FC9D8D68C0 (examinateur_id), INDEX IDX_FF826FC155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partenaire_adresse (partenaire_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_DCAEF6C14DE7DC5C (adresse_id), INDEX IDX_DCAEF6C198DE13AC (partenaire_id), PRIMARY KEY(partenaire_id, adresse_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE postulant (id INT AUTO_INCREMENT NOT NULL, dossier_id INT DEFAULT NULL, civilite_id INT DEFAULT NULL, connu_doranco_v3_id INT DEFAULT NULL, niveaux_etudes_id INT DEFAULT NULL, diplome_id INT DEFAULT NULL, situation_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, provenance_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, typeformation_id INT DEFAULT NULL, dispositif_id INT DEFAULT NULL, tchat_id INT DEFAULT NULL, archive TINYINT(1) DEFAULT NULL, isprospect TINYINT(1) DEFAULT NULL, nom VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, cp_descripteur VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, tel_fixe VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, tel_mobile VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, nationalite VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lieu_naissance VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, date_naissance DATE DEFAULT NULL, commentaire LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, complementaires LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, newsletter VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, id_domaines_metiers_occupe_de INT DEFAULT NULL, id_domaines_metiers_vise_de INT DEFAULT NULL, dernier_metier_occupe_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, metier_vise_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, date_inscription_pole_emploi DATE DEFAULT NULL, prescripteur_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, cp_prescripteur_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, annee_sortie_systeme_scolaire_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, duree_experience_professionnelle_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, intitule_dernier_diplome VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, etat_diplome VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, num_pole_emploi VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, contrat_csp INT DEFAULT NULL, mobiliser_contrat_csp INT DEFAULT NULL, offre_personnel TINYINT(1) DEFAULT NULL, cv VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, metier_occupe VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, repas TINYINT(1) DEFAULT NULL, statut VARCHAR(255) CHARACTER SET utf8 DEFAULT \'nontraite\' COLLATE `utf8_unicode_ci`, dataCreation DATETIME DEFAULT NULL, dataUpdated DATETIME DEFAULT NULL, reference VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, heuresCPF VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_F793951247A44D41 (typeformation_id), INDEX IDX_F7939512BCF5E72D (categorie_id), INDEX IDX_F7939512F23DAB06 (niveaux_etudes_id), UNIQUE INDEX UNIQ_F7939512CACEEE58 (tchat_id), INDEX IDX_F7939512D9BB2E9F (dispositif_id), INDEX IDX_F7939512C24AFBDB (provenance_id), INDEX IDX_F793951226F859E2 (diplome_id), INDEX IDX_F793951239194ABF (civilite_id), UNIQUE INDEX UNIQ_F7939512611C0C56 (dossier_id), INDEX IDX_F7939512B3E9C81 (niveau_id), INDEX IDX_F79395123408E8AF (situation_id), INDEX IDX_F7939512272894B5 (connu_doranco_v3_id), UNIQUE INDEX UNIQ_F79395124DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prospect (id INT AUTO_INCREMENT NOT NULL, dossier_id INT DEFAULT NULL, civilite_id INT DEFAULT NULL, connu_doranco_v3_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, profil_id INT DEFAULT NULL, tchat_id INT DEFAULT NULL, archive TINYINT(1) DEFAULT NULL, nom VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, cp_descripteur VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, tel_fixe VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, tel_mobile VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, nationalite VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lieu_naissance VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, date_naissance DATE DEFAULT NULL, commentaire LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, newsletter VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, id_situations_dE INT DEFAULT NULL, id_categories_de INT DEFAULT NULL, id_provenances_de INT DEFAULT NULL, id_niveaux_etudes_de INT DEFAULT NULL, id_domaines_metiers_occupe_de INT DEFAULT NULL, id_domaines_metiers_vise_de INT DEFAULT NULL, dernier_metier_occupe_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, metier_vise_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, date_inscription_pole_emploi DATE DEFAULT NULL, prescripteur_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, cp_prescripteur_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, annee_sortie_systeme_scolaire_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, duree_experience_professionnelle_de VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, connu_doranco VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, intitule_dernier_diplome VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, etat_diplome VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, num_pole_emploi VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, contrat_csp INT DEFAULT NULL, mobiliser_contrat_csp INT DEFAULT NULL, offre_personnel INT DEFAULT NULL, cv VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, metier_occupe VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, repas TINYINT(1) DEFAULT NULL, statut VARCHAR(255) CHARACTER SET utf8 DEFAULT \'nontraite\' COLLATE `utf8_unicode_ci`, dataCreation DATETIME DEFAULT NULL, dataUpdated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C9CE8C7D611C0C56 (dossier_id), INDEX IDX_C9CE8C7D272894B5 (connu_doranco_v3_id), UNIQUE INDEX UNIQ_C9CE8C7D4DE7DC5C (adresse_id), INDEX IDX_C9CE8C7D275ED078 (profil_id), UNIQUE INDEX UNIQ_C9CE8C7DCACEEE58 (tchat_id), INDEX IDX_C9CE8C7D39194ABF (civilite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE responsable_formation (id INT AUTO_INCREMENT NOT NULL, civilite_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, fonction VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, emailPro VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ligneDirect VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_BD0670A939194ABF (civilite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tiers_stage (tiers_id INT NOT NULL, stage_id INT NOT NULL, INDEX IDX_D409F9C168B77723 (tiers_id), INDEX IDX_D409F9C12298D193 (stage_id), PRIMARY KEY(tiers_id, stage_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_formation_experience (experience_id INT NOT NULL, type_formation_id INT NOT NULL, INDEX IDX_BBD718F0D543922B (type_formation_id), INDEX IDX_BBD718F046E90E27 (experience_id), PRIMARY KEY(experience_id, type_formation_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_public_experience (experience_id INT NOT NULL, type_public_id INT NOT NULL, INDEX IDX_233349F546E90E27 (experience_id), INDEX IDX_233349F5172CA81 (type_public_id), PRIMARY KEY(experience_id, type_public_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typeformation (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typepublic (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(65) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_widget ADD CONSTRAINT FK_EDCF6E7CC54C8C93 FOREIGN KEY (type_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE entreprise_personal_informations ADD CONSTRAINT FK_69E523D14D33B99D FOREIGN KEY (personal_informations_id) REFERENCES personal_informations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_personal_informations ADD CONSTRAINT FK_69E523D1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entretien_formateur_theme ADD CONSTRAINT FK_F502C8E61AF8CDF2 FOREIGN KEY (entretien_formateur_id) REFERENCES interview_informations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entretien_formateur_theme ADD CONSTRAINT FK_F502C8E659027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interview_informations ADD CONSTRAINT FK_FF826FC155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateurs (id)');
        $this->addSql('ALTER TABLE interview_informations ADD CONSTRAINT FK_FF826FC9D8D68C0 FOREIGN KEY (examinateur_id) REFERENCES employes (id)');
        $this->addSql('ALTER TABLE partenaire_adresse ADD CONSTRAINT FK_DCAEF6C14DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partenaire_adresse ADD CONSTRAINT FK_DCAEF6C198DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F79395124DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F793951226F859E2 FOREIGN KEY (diplome_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512C24AFBDB FOREIGN KEY (provenance_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F79395123408E8AF FOREIGN KEY (situation_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512D9BB2E9F FOREIGN KEY (dispositif_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F793951247A44D41 FOREIGN KEY (typeformation_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512BCF5E72D FOREIGN KEY (categorie_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512272894B5 FOREIGN KEY (connu_doranco_v3_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512CACEEE58 FOREIGN KEY (tchat_id) REFERENCES tchat (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F793951239194ABF FOREIGN KEY (civilite_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512F23DAB06 FOREIGN KEY (niveaux_etudes_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7DCACEEE58 FOREIGN KEY (tchat_id) REFERENCES tchat (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7D272894B5 FOREIGN KEY (connu_doranco_v3_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7D39194ABF FOREIGN KEY (civilite_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7D611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7D275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id)');
        $this->addSql('ALTER TABLE responsable_formation ADD CONSTRAINT FK_BD0670A939194ABF FOREIGN KEY (civilite_id) REFERENCES masterlistelgs (id)');
        $this->addSql('ALTER TABLE tiers_stage ADD CONSTRAINT FK_D409F9C12298D193 FOREIGN KEY (stage_id) REFERENCES stages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tiers_stage ADD CONSTRAINT FK_D409F9C168B77723 FOREIGN KEY (tiers_id) REFERENCES tiers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_formation_experience ADD CONSTRAINT FK_BBD718F046E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE type_formation_experience ADD CONSTRAINT FK_BBD718F0D543922B FOREIGN KEY (type_formation_id) REFERENCES typeformation (id)');
        $this->addSql('ALTER TABLE type_public_experience ADD CONSTRAINT FK_233349F5172CA81 FOREIGN KEY (type_public_id) REFERENCES typepublic (id)');
        $this->addSql('ALTER TABLE type_public_experience ADD CONSTRAINT FK_233349F546E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE cataloguefront DROP FOREIGN KEY FK_8EBD43AE6D6B297');
        $this->addSql('ALTER TABLE cataloguefront DROP FOREIGN KEY FK_8EBD43AE6D6B297');
        $this->addSql('DROP INDEX idx_8ebd43ae6d6b297 ON cataloguefront');
        $this->addSql('CREATE INDEX IDX_C58FACE2E6D6B297 ON cataloguefront (profil)');
        $this->addSql('ALTER TABLE cataloguefront ADD CONSTRAINT FK_8EBD43AE6D6B297 FOREIGN KEY (profil) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE CodeAbsences DROP FOREIGN KEY FK_5468F3B05D17678C');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499939F1F5D8F');
        $this->addSql('DROP INDEX IDX_603499939F1F5D8F ON contrat');
        $this->addSql('ALTER TABLE contrat DROP receptiondocs_id');
        $this->addSql('ALTER TABLE cv_experience DROP FOREIGN KEY FK_7A66549185E4725E');
        $this->addSql('DROP INDEX IDX_7A66549185E4725E ON cv_experience');
        $this->addSql('ALTER TABLE cv_experience DROP formateurexp_id');
        $this->addSql('ALTER TABLE dossierannexes DROP FOREIGN KEY FK_328F0D3E7CB1D3E5');
        $this->addSql('DROP INDEX IDX_328F0D3E7CB1D3E5 ON dossierannexes');
        $this->addSql('ALTER TABLE dossierannexes DROP reunion_pole_emploi_id');
        $this->addSql('ALTER TABLE dossiers CHANGE itempes itempes LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE financements DROP concernefrais');
        $this->addSql('ALTER TABLE financeurs DROP FOREIGN KEY FK_41B82BA97849EC3D');
        $this->addSql('DROP INDEX IDX_41B82BA97849EC3D ON financeurs');
        $this->addSql('ALTER TABLE financeurs DROP financementopco_id');
        $this->addSql('ALTER TABLE fos_group ADD name VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B019DDB5E237E06 ON fos_group (name)');
        $this->addSql('ALTER TABLE fos_user ADD username VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD username_canonical VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD email_canonical VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('ALTER TABLE mailreceptioncandidatures ADD parcours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mailreceptioncandidatures ADD CONSTRAINT FK_2115229F6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('CREATE INDEX IDX_2115229F6E38C0DB ON mailreceptioncandidatures (parcours_id)');
        $this->addSql('ALTER TABLE masterlistelgs CHANGE designation designation VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE valeur valeur VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE valeur2 valeur2 VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE menu_content_page CHANGE dataCreation dataCreation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE participant CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE tel tel VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE societe CHANGE imagerib imagerib VARCHAR(250) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE statut_juridique CHANGE dateinscription dateinscription DATETIME NOT NULL, CHANGE datemodification datemodification DATETIME DEFAULT NULL');
    }
}
