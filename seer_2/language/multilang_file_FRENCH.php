<?php

/*
A TRANSLATION (LANGUAGE FILE) FOR S.E.E.R.
---------------------------------------------------------------------
System and Environment Effective Reports
Compatible with...
-- version 2, codename: Brahma Bull
     ________________
   `/    \-'  '-/    \`
          \    /
          (\||/)
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 7 LINES MAY NOT BE REMOVED, but may be
     appended with additional contributor info.
 S.E.E.R. Language File Copyright (C) 2010, 2011, 2012, 2013, 2016
 V. Spinelli for SpinelliCreations. This program comes 
 with ABSOLUTELY NO WARRANTY. This is open code, released 
 under Creative Commons 3.0 Share Alike, Unported License,
 and you are welcome to redistribute it, with this tag 
 in tact.
	... http://www.spinellicreations.com
---------------------------------------------------------------------
---------------------------------------------------------------------
CONTACT		
		Author			Hakan Koni and Associates
				Email:	HakanKoni@Gmail.com
				Site:	n/a
				Handle:	n/a

		Copyright Holder	SpinelliCreations
				Email:	Vince@SpinelliCreations.com
				Site:	http://www.spinellicreations.com
---------------------------------------------------------------------
S.E.E.R. LANGUAGE FILE
-- FRENCH
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* S.E.E.R. LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/* RULES FOR MAKING AND EDITING LANGUAGE FILES */
/* ------------------------------------------------------------------ 	
	Unless otherwise noted, the ENGLISH language file is to be considered the 'Master Copy'
	upon which all other language files are to be based.

	-- If creating a NEW language file, then the file must be named...
		multilang_file_[LANGUAGE].php (located in the /seer_2/language folder)
	   Edit the /config/globaloptions_seer_0.php file to reflect the addition
	        of another available language.
	-- If editing an existing language file, or converting text for a language
		file, then all VARIABLES should be copied from the ENGLISH file, and
		defined appropriately in the OTHER language file(s).
	-- Observe case-sensitivity.
		-- -- If a variable is defined with uppercase-letters in ENGLISH, then
		      it should be defined with uppercase-letters in the translation.
		-- -- Example 1:
			$multilang_STATIC_0 = "Welcome";    (in ENGLISH)
			$multilang_STATIC_0 = "Bienvenido"; (in SPANISH)
		-- -- Example 2:
			$multilang_STATIC_HOURS = "HOURS";	(in ENGLISH)
			$multilang_STATIC_HOURS = "HORAS";	(in SPANISH)
		-- -- Failure to comply with case-sensitivity will result in skewed
		      otherwise odd-looking display behavior (where certain tags 
		      appear out of place).
	-- Observe special characters.
		-- -- If a variable is defined with "_" or "-" or "..." or 3another other
		      special characters, then they should be included in the
		      translation.
	-- Observe punctuation and capitalization.
		-- -- Some variables are sentences, which may or may-not start with a 
		      capital letter and may or may-not end with a period.  Whichever
		      is the case, carry it over with the translation.
	-- Observe character limits.
		-- -- Some variables are labeled with a limit on character number.  This
		      is because those variables have only a limited space within which
		      to be displayed.  A good example of this is the MENU tags, most of
		      which are limited to 21 characters.  Each is labeled as such.  If
		      you must abbreviate in the translation in order to preserve the
		      character limit, then do so.

	-- Use common sense.
		-- -- Some variables are abbreciations, such as "Temp" for "Temperature", or
		      "MPH" for "Miles per Hour".  Should you come across such a variable,
		      then we ask that you translate the phrase, and then provide an 
		      appropriate abbreviation in the translated language.
		-- -- Try to preserve roughly the same string length for variables.
		      Obviously, for longer sentences or paragraphs, this does not matter at
		      all.  However, tags, flags, and other "one or two word" variables should
		      be replaced with AS SHORT OF A TRANSLATION AS POSSIBLE.  For example,
		      	$multilang_STATIC_2 = "What is It?";	(ENGLISH)
			..., should not be replaced with a 10 word string unless absolutely
			necessary.
	-- Off limits.
		-- -- Any variable that is defined as another variable should not be edited
		      unless you intend to modify the program.  The purpose of these variables
		      acting redundantly is to allow portions of pages to be modified later
		      without major reconstruction if necessary.  That being said, these
		      variables are identified as...
			$master_variable = "SOMETHING";
			$slave_variable = $master variable;
					-- do not edit unless modifying program.
		-- -- DO NOT create additional slave variables, or link any variable
		      to another variable unless it has been done so already in the
		      ENGLISH version (master copy).
   ------------------------------------------------------------------ */

/*	-- STATIC PAGES */
/*	--------------- */
$multilang_STATIC_0 = "Bienvenue";
$multilang_STATIC_1 = "A propos";
$multilang_STATIC_2 = "Qu'est-ce que c'est?";
$multilang_STATIC_3 = "est entierement equipe d'une Human Machine Interface (HMI), avec toutes les caracteristiques d'un Controle de Surveillance moderne et d'un systeme d'Acquisition de donnees(SCADA), et releve la barre en integrant la Generation de Rapport.";
/*			-- a lire tel que... 'S.E.E.R. est entierement equipe... etc etc...' */
$multilang_STATIC_4 = "Pour toutes fins utiles, S.E.E.R. est une interface pour le mod_openopc (le moteur derriere tous les outils de communications en direct OPC, donnees d'identification, et instructions). Dans la plupart des cas, il offre toutes les cararcteristiques des autres plus couteux, non-cross-platforme compatible aux competiteurs... S.E.E.R. est tout ce qui s'agit de vous et votre plante(ou application).";
$multilang_STATIC_5 = "Compatabilite pour les Utilisateurs ";
$multilang_STATIC_6 = "Nous sommes conscients que si vous pouvez etre en mesure d'acquerir ou de construire un super serveur,nombre de vos utilisateurs peuvent posseder des ordinateurs leur permettant de se connecter et utiliser le systeme.Pas de probleme,nous avons concu S.E.E.R. conforme a la specification HTML DTD specification 4.01 Transitoire...de sorte qu'il fonctionne sur tout ordinateur qui peut ouvrir un navigateur web coforme standard.Aucun branchement, aucun applets Java, aucune extension louche de tierse partie a telecharger...pas de conneries... Tout le travail est fait cote serveur, et les resultats affiches en HTML. Cela signifie que toute personne sur n'importe quel systeme d'exploitation peuvent voir S.E.E.R. Et depuis que chaque session de recherche est un lien unique sur l'hebergement partage,un nombre illimite d'utilisateurs peuvent se connecter simultanemment et se servir de S.E.E.R. ... Vous pouvez oublier 'licenses acces clients'.";
$multilang_STATIC_7 = "Open Source pour Open Standards";
$multilang_STATIC_8 = "Voici la meilleure partie.S.E.E.R.est directement construit pour openOPC, base sur le travail prealable du createur du projet. mod_openopc est fonde sur le travail fantastique de Barry Barnreiter sur le projet de OpenOPC. Ces trois outils individuels partagent un heritage, une philosophie et un objectif commun...";
$multilang_STATIC_9 = "Ils sont tous les projets Open Source, sous licence GNU GPL sous une forme ou une autre."; 
$multilang_STATIC_10 = "Ce que cela signifie  le code source vous est entierement accessible. Donc, vous pouvez l'utiliser comme il est, le modifier, ou faire ce qui est necessaire pour faire fonctionner vos applications particulieres.";
$multilang_STATIC_11 = "Plates-formes serveur";
$multilang_STATIC_12 = "mod_openopc est ecrit en pur Python, un langage multi-plateforme, et vous permet de rassembler un nombre illimite de points de donnees a partir d'un nombre illimite de peripheriques connectes OPC. Connectez-vous a n'importe quelle version 1 / 2 ou 3 OPC Server (par exemple que RSLinx, Kepware, Matrikon, InGear, etc ..) avec mod_openopc et commencer a etirer toutes les donnees de la machine dont vous rever en ordre bien range des bases de donnees MySQL de Sun Microsystems, qui sont ensuite accessibles a la maniere que vous le souhaitez (nous avons simplement choisi SEER comme un moyen d'acceder a cette base de donnees).";
$multilang_STATIC_13 = "Ultime Customisation";
$multilang_STATIC_14 = "Si vous etes pret a travailler avec PHP (pour la mise en place de vos rapports personnalises et de l'IHM pour vos machines), alors SEER et mod_openopc peuvent vous fournir la supervision du controle et des connections, a la portee de n'importe qui avec un web- navigateur.";
$multilang_STATIC_15 = "A la puissance des Penguins";
$multilang_STATIC_16 = "S.E.E.R. est ccompatible avec Unix.En effet, SEER et mod_openopc ont ete initialement developpe sur Linux Fedora Core (version 8), et plus tard modifie pour etre compatible avec Windows. Ceci dit, les performances d'Apache, PHP, MySQL et Python sous Unix s'eclipsent completement sous Windows Toutefois, si vous n'etes pas a l'aise pour passer a une plate-forme Unix, soyez rassure, la compatibilite Win32/64 est incluse."; 
$multilang_STATIC_17 = "Dernieres nouvelles";
$multilang_STATIC_18 = "Pour plus d'informations ou des nouvelles sur mod_openopc et SEER, visitez la page du projet sur..."; 
$multilang_STATIC_19 = "Copyright et Licence";
$multilang_STATIC_20 = "Gratuite sous tous les aspects";
$multilang_STATIC_21 = "SEER et mod_openopc sont des logiciels gratuits. Si vous avez paye pour l'un ou l'autre, alors vous etes la victime d'une fraude. Bien que n'importe qui, n'importe ou, peut (et devrait) exiger des frais pour le soutien,le depannage,l'installation,les conseils techniques concernant ou SEER ou mod_openopc, toutes les personnes et entites ont l'interdiction de percevoir des frais pour le CODE SOURCE.";
$multilang_STATIC_22 = "Copyright";
$multilang_STATIC_23 = "Licence";
$multilang_STATIC_24 = "Vous pouvez lire les termes de la licence ici...";
$multilang_STATIC_25 = "Demande de Documentation";
$multilang_STATIC_26 = "Documents S.E.E.R.";
$multilang_STATIC_27 = "Documents mod_openopc";
$multilang_STATIC_28 = "Tous les documents du systeme sont ecris en anglais, qui est la meme langue que tout le code source du systeme Nous nous excusons pour tout inconvenient."; 
$multilang_STATIC_29 = "Exporter un fichier";
$multilang_STATIC_30 = "Une erreur s'est produite lors de l'exportation du fichier le contenu n'a pas ete precise.";
$multilang_STATIC_31 = "Nous proposons";
/*			-- A interpreter comme ... Nous suggerons que ce bon vin ... */
$multilang_STATIC_32 = "pour tous vos besoins au bureau";
/*			-- A interpreter comme... Cette agrafeuse a toute son utilite au bureau */ 
$multilang_STATIC_33 = "Votre fichier d'exportation est maintenant disponible a telecharger...";
$multilang_STATIC_34 = "un simple clic droit sur le fichier et selectionnez:";
$multilang_STATIC_35 = "Sauvegarder comme pour recuperer le fichier.";
$multilang_STATIC_36 = "Agent de la circulation";
/*			-- A interpreter comme ... "Redirection automatique" ou * "gestionnaire de session" */
$multilang_STATIC_37 = "Redirection vers votre cible ...";
/*			-- A interpreter comme "Redirection [vous] a votre cible [destination souhaitee ]'... */
$multilang_STATIC_38 = "Connexion utilisateur";
/*			-- A interpreter comme... 'connexion Utilisateur' ou s'identifier*/
$multilang_STATIC_39 = "Connexion reussie ...";
/*			-- A interpreter comme 'Ouverture de session reussie ... ou inscription signe le ... */
$multilang_STATIC_40 = "Echec de la connexion...";
/*			-- A interpreter comme... 'Echec de connexion...' ou 'inscription echouee'...' */
$multilang_STATIC_41 = "Proceder en utilisant le menude haut en bas.";
$multilang_STATIC_42 = "S'il vous plait essayez de nouveau Rappelez-vous, tous les noms d'utilisateur et mots de passe sont sensibles a la casse.!";
$multilang_STATIC_43 = "Nous sommes desoles Quelqu'un est deja connecte a partir de ce terminal.";
$multilang_STATIC_44 = "S'il vous plait Deconnectez-vous avant de tenter de vous connecter a nouveau.";
$multilang_STATIC_45 = "Les coordonnees de l'utilisateur actif sont ...";
$multilang_STATIC_46 = "nom d'utilisateur:";
/*			-- Invite de connexion */
$multilang_STATIC_47 = "mot de passe:";
/* 			-- Invite de connexion */
$multilang_STATIC_48 = "Si vous n'avez pas de nom d'utilisateur ou de mot de passe,s'il vous plait contactez le systeme administrateur de l'aide.";
$multilang_STATIC_49 = "Deconnexion";
$multilang_STATIC_50 = "L'utilisateur est actif ou connecte ..";
$multilang_STATIC_51 = "Au revoir.";
$multilang_STATIC_52 = "Machine Control et Live Status";
$multilang_STATIC_53 = "Rapports et Syntheses";
$multilang_STATIC_54 = "Contact Aide et assistance";
$multilang_STATIC_55 = "Administrateurs";
$multilang_STATIC_56 = "Instructions generales Contact";
$multilang_STATIC_57 = "Contat Instructions urgentes";
$multilang_STATIC_58 = "Foire aux Questions";
$multilang_STATIC_59 = "Ossatture Systeme Fautes";
$multilang_STATIC_60 = "En direct a";
/*			-- interpreter comme 'live a [heure]' */
$multilang_STATIC_61 = "Felicitations!";
$multilang_STATIC_62 = "Il ya eu 0 (zero) defauts constates sur la periode que vous avez demande.";
$multilang_STATIC_63 = "Datestamp";
$multilang_STATIC_64 = "Erreur";
$multilang_STATIC_65 = "Execution";
$multilang_STATIC_66 = "OPC Serveur";
$multilang_STATIC_67 = "Classee par";
$multilang_STATIC_68 = "Il y a actuellement 0 (ZERO) fautes. L'ossature devrait fonctionner normalement.";
$multilang_STATIC_69 = "Logiciel Archive";
$multilang_STATIC_70 = "Fichiers trouves correspondant a vos criteres de recherche sur le serveur.Ils sont enumeres ci-dessous pour votre appreciation ...";
$multilang_STATIC_71 = "Aucun fichier n'a ete trouve correspondant a vos criteres de recherche sur le serveur.";
$multilang_STATIC_72 = "Votre recherche de fichiers a donne le resultat suivant ...";
$multilang_STATIC_73 = "Votre fichier a  telecharger a donne le resultat suivant ...";
$multilang_STATIC_74 = "Bienvenue aux archives du logiciel. Vous trouverez ici un repertoire de ce qui doit etre considere comme essentiel a la mission de sauvegardes HMI,PLC, automate, et d'autre logique du controleur. De plus, vous trouverez le logiciel ossature necessaire a manipuler et executer les programmes.";
$multilang_STATIC_75 = "Comme toujours, soyez avise que l'utilisation de ces fichiers est strictement interdite en dehors du champ d'application de (et peut-etre lieu de) votre lieu d'affaires. L'acces a ces fichiers est volontairement limite a l'entretien ou du personnel des metiers specialises, justement pour cette raison . Tout logiciel necessitant une cle de licence doit etre installe et [ou] utilise uniquement en conformite avec cette politique de saisie.";
$multilang_STATIC_76 = "Vous pouvez naviguer par Backbone logiciels (systemes d'exploitation, outils de creation, etc ..) ou par Runtime Software (logiciel de commande en direct-to-run).";
$multilang_STATIC_77 = "Enfin, lors du telechargement de nouveaux fichiers, s'il vous plait choisir la categorie dans laquelle ils doivent etre places, et respecter la convention de nommage.Si vous ne pouvez pas decompresser ou pack de fichiers tar (comme des fichiers 'zip'), l'utilitaire 7-zip freeware est inclus pour Windows et Unix web la taille maximale a telecharger par-file-size est de 50 MB.";
$multilang_STATIC_78 = "Convention nominative"; 
$multilang_STATIC_79 = "TYPE"; 
$multilang_STATIC_80 = "CATEGORIE"; 
$multilang_STATIC_81 = "FOURNISSEUR-OU-FABRICANT"; 
$multilang_STATIC_82 = "NOM"; 
$multilang_STATIC_83 = "VERSION"; 
$multilang_STATIC_84 = "DATE-TELECHARGEE"; 
$multilang_STATIC_85 = "EXTENSION"; 
/*                      -- a lire comme ... '[DOSSIER] EXTENSION' */
$multilang_STATIC_86 = "pour les logiciels D'EXECUTION, situer 'FOURNISSEUR-ou-FABRICANT' avec 'PLAN' ou 'LOCALISATION'";
$multilang_STATIC_87 = "par exemple ..."; 
$multilang_STATIC_88 = "ou"; 
/*                     -- a lire comme ... '[OPTION A] ou [OPTION B]' */ 
$multilang_STATIC_89 = "Fichier navigation et recherche Dialogue"; 
$multilang_STATIC_90 = "Critere de FICHIER sur le serveur ..."; 
$multilang_STATIC_91 = "remplir tous les champs connus, laisser les inconnus par defaut ou vide"; 
$multilang_STATIC_92 = "TRANSMIT-PAR"; 
$multilang_STATIC_93 = "Executer Recherche de FICHIER sur le Serveur"; 
$multilang_STATIC_94 = "AUCUN"; 
$multilang_STATIC_95 = "Selectionner le fichier a transmetre"; 
$multilang_STATIC_96 = "Nom du FICHIER sur le serveur"; 
$multilang_STATIC_97 = "Transmettre le FICHIER au serveur"; 
$multilang_STATIC_98 = "Documents et Manuels Techniques "; 
$multilang_STATIC_99 = "Bienvenue aux Archives techniques. Ici vous trouverez un repertoire de ce qui doit etre considere sauvegardes Mission Critique des materiels et logiciels de documentation, couvrant les appareils mecaniques et electriques."; 
$multilang_STATIC_100 = "Vous pouvez naviguer par 'mecanique','magnetique', 'chimique' ou 'autre'";
$multilang_STATIC_101 = "Telecharger le fichier Dialogue";
$multilang_STATIC_102 = "Si vous voulez essayer a nouveau, cliquez ici ...";
$multilang_STATIC_103 = "Parametres: Ajouter des utilisateurs";
$multilang_STATIC_104 = "Si vous souhaitez ajouter un autre utilisateur, cliquez ici ...";
$multilang_STATIC_105 = "Cet utilisateur a ete ajoute avec succes a la table Access.";
$multilang_STATIC_106 = "Parametres: Supprimer des utilisateurs";
$multilang_STATIC_107 = "La suppression utilisateur ou un groupe que vous avez demandee a ete realisee avec succes. Veuillez consulter la liste ci-dessous, a nouveau, afin de vous assurer que vous avez atteint le resultat souhaite..";
$multilang_STATIC_108 = "Veuillez noter que vous ne pouvez pas supprimer un utilisateur qui a un niveau d'acces superieur au votre.";
$multilang_STATIC_109 = "Veuillez noter que vous ne pouvez pas modifier un utilisateur qui a un niveau d'acces superieur au votre.";
$multilang_STATIC_110 = "portail de formation Kiosk";
$multilang_STATIC_111 = "Si votre envoi a reussi, assurez-vous d'ecrire le nom du fichier tel qu'il apparait ici sur l'ecran Vous en aurez besoin plus tard pour joindre le fichier a votre page projet bien sur dans le Wiki..";
$multilang_STATIC_112 = "CREATION D'UN LIEN FICHIER NOM";
$multilang_STATIC_113 = "C'est le portail de formation Kiosque. D'ici vous pouvez entrer dans le Portail de la formation, ou telecharger des donnees sur le Repertoire de la formation  (necessite ADMINISTRATEUR ou super utilisateur de niveau d'acces).";
$multilang_STATIC_114 = "Parametres: systeme et utilisateurs";
$multilang_STATIC_115 = "Connecte en tant que";
/*                      -- A interpreter comme... 'connecte en tant que [nom d'utilisateur]' */
$multilang_STATIC_116 = "Plate-forme de developpement";
$multilang_STATIC_117 = "Le serveur de production";
$multilang_STATIC_118 = "Aucun utilisateur n'est actif sur ce terminal.";
$multilang_STATIC_119 = "Bienvenue dans ...";
/*                      -- A interpreter comme... 'Bienvenue a... [endroit]' */
$multilang_STATIC_120 = "Veuillez d'abord vous CONNECTER;en utilisant le bouton en haut a droite. Ensuite, utilisez la barre de menu ci-dessus, pour naviguer vers votre destination Si vous avez des problemes, n'hesitez pas a utiliser le lien Aide et support, ci-dessous...";
$multilang_STATIC_121 = "l'Outil de Puissance OPC Power ";
$multilang_STATIC_122 = "Parametres: Modifier utilisateur";
$multilang_STATIC_123 = "Derniere activite";
$multilang_STATIC_124 = "WEB-HOTES";
/*			-- a interpreter comme... '[Aucun utilisateur n'est connecte, donc vous avez le nom par defaut] 'WEB-GUEST'". */
$multilang_STATIC_125 = "Sante du serveur";
$multilang_STATIC_126 = "SYSINFO";
/*			--a interpreter comme... '[abbreviation de] System Information' */
$multilang_STATIC_127 = "modifie et integre dans SEER";
/*			-- a interpreter comme.. '[quelque chose] modifie et integre dans S.E.E.R.' */
$multilang_STATIC_128 = "Copyright";
/*			-- a interpreter comme... '[quelque chose] Copyright [annees]' */
$multilang_STATIC_129 = "Licence Exclusive";
/*			-- a interpreter comme "il y a une  seule unique licence" */

/*	-- FAQ */
/*	------ */
$multilang_FAQ_1Q = "Apres avoir mis a jour une valeur ou appuye sur une touche, il semble que cela prend une minute pour apparaitre sur mon ecran Pourquoi est-il si lent?"; 
$multilang_FAQ_1A = "En fait, votre mise a jour ou de la commande a ete immediatement envoye a la machine. Toutefois, les donnees sont recueillies toutes les secondes X »(10, 30, 60, ou selon secondes). Vous ne pourrez donc pas actuellement voir le resultat avant que le prochain lot de donnees ai ete recueilli et votre page actualisee automatiquement.";
$multilang_FAQ_2Q = "Mon ecran apparait 'mauvais' un peu dans Microsoft Internet Explorer 6, ou parfois il ne fonctionne tout simplement pas bien Pourquoi?"; 
$multilang_FAQ_2A_11 = "SEER a ete developpe pour les navigateurs conformes stanards conforme a la specification HTML 4.01 Transitional DTD. Il s'agit d'un standard ouvert qui est multi-plateforme compatible (fonctionne sur n'importe quel systeme d'exploitation). Malheureusement, MS IE-6 n'est pas compatible avec les standards. Nous vous recommandons d'utiliser SEER avec un navigateur robuste et complet tel que "; 
$multilang_FAQ_2A_12 = "Si vous devez absolument utiliser un navigateur non conforme aux standards, tels que MS Internet Explorer, alors,au moins , veuillez remettre a jour MS IE version 8, qui, n'etant pas encore l'ideal, de bien meilleures performances que les versions precedentes de IE. ";
$multilang_FAQ_2A_21 = "S.E.E.R a ete teste et prouve contre";
$multilang_FAQ_2A_22 = "Apple Safari v.3 and 4 [Excellent]";
$multilang_FAQ_2A_23 = "Konqueror v.3.5.x [Excellent]";
$multilang_FAQ_2A_24 = "Opera v.10 [Good]";
$multilang_FAQ_2A_25 = "Mozilla Firefox v.3.0.x [Excellent - norme de Comparaison]";
$multilang_FAQ_2A_26 = "Google Chrome v.4.0.249 (Beta) [Bon]";
$multilang_FAQ_2A_27 = "Microsoft IE v.6 [Affichage faible, certains rapports ne s'affichent pas]";
$multilang_FAQ_2A_28 = "Microsoft IE v.7 & 8 [Bon -(echelle de l'image est mauvaise)]";
$multilang_FAQ_2A_31 = "S.E.E.R a ete teste et a echoue contre ...";
$multilang_FAQ_2A_32 = "Opera v.9 et precedentes [Non-visionable -le navigateur ne traite pas correctement les objets du niveau]"; 
$multilang_FAQ_2A_33 = "Microsoft IE version 5.5 [Non-visionable - le manque de soutien CSS 2, de nombreux autres problemes]"; 
$multilang_FAQ_3Q = "J'utilise Microsoft Internet Explorer 8 ou plus, et tous les champs de saisie de texte (l'utilisateur de connexion, la saisie manuelle des donnees, etc ..) apparaissent comme des champs tres petits, avec des lettres minuscules et des chiffres. Comment puis-je resoudre ce probleme?"; 
$multilang_FAQ_3A_11 = "Ceci est un bug / violation de conformite au sein de MSIE Il est tentant d'appliquer des styles visuels sur des elements de formulaire sans avoir ete demande par le systeme SEER Pour resoudre ce probleme, a l'interieur de MSIE, aller a..."; 
/*			-- interpreter comme '... allez dans [puis suivre les instructions]' */
$multilang_FAQ_3A_12 = "OUTILS";
/*			-- MSIE v8 element du menu */
$multilang_FAQ_3A_13 = "OPTIONS INTERNET";
/*			-- MSIE v8 element du menu */
$multilang_FAQ_3A_14 = "AVANCE";
/*			-- MSIE v8 element du menu */
$multilang_FAQ_3A_15 = "NAVIGATION";
/*			-- MSIE v8 element du menu*/
$multilang_FAQ_3A_16 = "et assurez vous que les TOUCHES ET CONTROLES MUET VISUEL sont sur OFF [PAS-VERIFIER!]";
/*			-- MSIE v8 element du menu */
$multilang_FAQ_4Q = "Si je mets a jour mon ordinateur,S.E.E.R fonctionnera-t-il mieux,sera-t-il plus rapide, etc?";
$multilang_FAQ_4A = "non SEER tourne 'cote serveur' a 100%, ce qui signifie que tout le travail  se fait sur un serveur distant, et non sur votre ordinateurlocal. Tous vos PC montrent l'affichage d'une simple page web. Ce qui permet a SEER d'etre effectivement utilise par les clients sur du materiel aussi vieux que la generation Pentium II (vers 1995). En general, n'importe quel ordinateur qui peut executer un navigateur web moderne, peut utiliser efficacement les fonctions S.E.ER. Vous vous demandez comment obtenir un navigateur moderne sur l'ancien materiel? ... Jetez un oeil a ";
/*			-- Derniere partie de la declaration est a lire comme ... "Jetez un oeil a [Damn Small Linux]. Le lien est integre dans la source. */
/*         -- BANNIERES */ 
/*         ------------ */ 
$multilang_STATIC_START = "Demarer";
$multilang_STATIC_END = "Fin";
$multilang_STATIC_LEVEL = "NIVEAU";
/*                      -- a lire comme '[Access] NIVEAU' ou 'NIVEAU [d'acces]' */
$multilang_STATIC_NOTE = "NOTE";
$multilang_STATIC_DENIED = "Acces refuse";
$multilang_STATIC_ACCESS_SKILLED_TRADES = "RESERVE AUX PERSONNELS QUALIFIES.";
$multilang_STATIC_ACCESS_ADMIN_SUPER = "RESERVE AUX ADMINISTRATEURS et AUX UTILISATEURS AVERTIS.";
$multilang_STATIC_ACCESS_LEVEL_LOW = "Vous ne vous etes pas IDENTIFIE ou votre NIVEAU D'ACCES n'est pas suffisent pour voir cette section. Si vous croyez que c'est une erreur, s'il vous plait contactez votre ADMINISTRATEUR DU SYSTEME.";
$multilang_STATIC_YES = "OUI";
$multilang_STATIC_NO = "NON";
$multilang_STATIC_AUTO = "AUTOMATIQUE";
$multilang_STATIC_MANUAL = "MANUELLE";
$multilang_STATIC_MODEL_ID = "Modele d'Identification";
$multilang_STATIC_REPORT = "Rapport";
$multilang_STATIC_HMI = "HMI";
$multilang_STATIC_NAME = "nom";
$multilang_STATIC_TITLE  = "titre";
$multilang_STATIC_DEPT  = "ministere";
$multilang_STATIC_EMAIL = "email";
$multilang_STATIC_PHONE  = "telephone";
$multilang_STATIC_YEAR = "ANNEE";
$multilang_STATIC_MONTH  = "MOIS";
$multilang_STATIC_DAY  = "JOUR";
$multilang_STATIC_HOUR = "HEURE";
$multilang_STATIC_MINUTE = "MINUTE";
$multilang_STATIC_DATESTAMP = "Datestamp";
$multilang_STATIC_DATESTAMP_CAPS = "DATESTAMP";
$multilang_STATIC_START_OF_LOG  = "Debut du journal";
$multilang_STATIC_END_OF_LOG  = "Fin du journal";
$multilang_STATIC_SELECT  = "CHOIX";
$multilang_STATIC_DISPLAY_REPORT_TICKET = "Afficher Rapport Ticket";
$multilang_STATIC_EXPORT_HEADER = "Exporte et Sauvegarde le Rapport de Donnees";
$multilang_STATIC_EXPORT_REPORT = "Exporte les donnees de ce rapport comme un fichier CSV (pour l'utilisation du tableur Office)";
$multilang_STATIC_NONE  = "AUCUN";
$multilang_STATIC_AGGREGATE = "TOTAL";
$multilang_STATIC_DISCRETE = "DISCRET";
$multilang_STATIC_SYNERGISTIC = "SYNERGETIQUE";
$multilang_STATIC_SNAPSHOT_LENGTH = "Longueur de la Capture Instantanee";
$multilang_STATIC_SNAPSHOT = "Capture Instantanee";
$multilang_STATIC_YEARS  = "ANNEES";
$multilang_STATIC_MONTHS  = "MOIS";
$multilang_STATIC_DAYS = "JOURS";
$multilang_STATIC_HOURS  = "HEURES";
$multilang_STATIC_MINUTES  = "MINUTES";
$multilang_STATIC_RANGE  = "CATEGORIE";
$multilang_STATIC_CERTIFIED = "CERTIFIE";
$multilang_STATIC_CERTIFIED_BY  = "CERTIFIE PAR";
$multilang_STATIC_COMMENT = "COMMENTAIRE";
$multilang_STATIC_CERTIFIED_HIGHLIGHT = "dossiers qui exigent la CERTIFICATION sont mis en EVIDENCE ceux qui SONT CERTIFIES ont ete mis en evidence en VERT Ceux qui ne sont pas certifies ont ete surlignees en rouge.";
$multilang_STATIC_REPORT_TICKET_FOR = "Rapport Ticket pour";
$multilang_STATIC_AS_USER = "en tant qu'utilisateur";
/*		-- a interpreter comme... '[evenement XYZ -- Joe Smith -- ] en tant qu'utilisateur [jsmith1]' */
/*		-- Egalement acceptable ... "[Quelque chose] identifie par [autre chose] */
$multilang_STATIC_DNE = "INCONNU ou N'EXISTE PLUS";
$multilang_STATIC_NA = "N/A";
$multilang_STATIC_UNKNOWN = "INCONNU";
/*			-- a interpreter... [abreviation pour] 'Non Applicable' */
$multilang_STATIC_REGULATORY = "Reglementaire";
$multilang_STATIC_AUTO_SCALE_DISPLAY = "Auto-Affichage a l'Echelle?";
/*			-- ... 'Auto[matiquement] Affiche le Rapport a l'Echelle' [OUI OU NON] */
$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY = "Donnees Enregistrees durant les Alertes du Systeme?";
/*			-- a interpreter comme... '[Affichage] Donnees Enregistrees durant System Alertes Seulement[toutes les alertes]?' */
$multilang_STATIC_Y_OR_N = "O ou P";
/*			-- a interpreter comme... [abreviation pour] 'OUI ou NON' */
$multilang_STATIC_YES  = "OUI";
$multilang_STATIC_NO  = "PAS";
$multilang_STATIC_START_TIME = "Heure de debut";
$multilang_STATIC_START_TIME_CAPS = "HEURE DE DEBUT";
$multilang_STATIC_END_TIME = "Heure de Fin";
$multilang_STATIC_END_TIME_CAPS  = "HEURE DE FIN";
$multilang_STATIC_REPORT_TIME  = "etre informes du fait que ce rapport necessite quelques instants pour etre genere. veuillez etre patient et ne quittez pas cette page ou vous serez deconnecte."; 
$multilang_STATIC_ITEMIZED  = "liste detaillee";
$multilang_STATIC_RANK = "RANG";
$multilang_STATIC_FREQUENCY = "FREQUENCE";
$multilang_STATIC_SYNERGISTIC_PARETO = "Synergetiques Pareto";
$multilang_STATIC_DISCRETE_PARETO = "Discret Pareto";
$multilang_STATIC_DISCRETE_ITEMS  = "Elements Discrets";
$multilang_STATIC_SORTING_STATUS  = "Etat du Tri";
$multilang_STATIC_CONGRATULATIONS  = "Felicitations!";
$multilang_STATIC_ITEM = "OBJET";
$multilang_STATIC_ITEM_LOWER = "Objet";
$multilang_STATIC_RERUN_REPORT  = "Executer ce Rapport sur un autre Objet ou Systeme au cours de la meme periode";
$multilang_STATIC_NEXT_ITEM_ID  = "Objet suivant ID";
$multilang_STATIC_ERROR_CALL_ADMIN = "Si vous pensez que c'est une erreur, veuillez contacter un administrateur pour vous aider.";
$multilang_STATIC_DATA_TICKET = "Ticket de Donnees";
$multilang_STATIC_NO_DATA_AVAILABLE = "PAS DE DONNEES DISPONIBLES";
$multilang_STATIC_RECORD_MANUALLY_ADDED  = "l'enregistrement a ete Ajoute manuellement";
$multilang_STATIC_CERTIFICATION_TICKET = "Ticket de Certification";
$multilang_STATIC_NUMBER_OF_RECORDS  = "Nombre d'Enregistrements";
$multilang_STATIC_SERVER = "Serveur";
$multilang_STATIC_DB_TABLE = "Tableau de Base de donnees";
$multilang_STATIC_DATE_RANGE = "Date Rangee";
$multilang_STATIC_YOUR_USERNAME = "Votre nom d'utilisateur";
$multilang_STATIC_CURRENT_TIME = "Heure actuelle";
$multilang_STATIC_SERVER_TIME = "Heure du serveur";
$multilang_STATIC_CONFIRMATION_OF_TICKET  = "Confirmation du ticket de donnees";
$multilang_STATIC_AUTO_CERT_BY = "automatiquement Certifie par";
$multilang_STATIC_CERT_STAMP = "Cachet de Certification";
$multilang_STATIC_CERT_COMMENT  = "Commentaire de certification";
$multilang_STATIC_INPUT_MORE_RECORDS = "Pour enregistrer plus d'entrees,cliquez ici.";
$multilang_STATIC_CERT_INSPECT_LIST = "Vous devriez consulter cette liste (ou l'imprimer pour vos dossiers), et assurez-vous que tous les enregistrements que vous avez voulu entrer ont effectivement pris place. Le systeme d'auto-effacera(ignorer) tous les documents pour lesquels des donnees erronees ou incompletes ont ete entrees. Vous pouvez toujours revenir en arriere et ajouter d'autres dossiers, si c'est le cas";
$multilang_STATIC_DISPLAY_RECORDS_FOR_CERT = "Afficher les enregistrements Acceptables a la Certification";
$multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER = "Enregistrer les Donnees du ticket au Serveur";
$multilang_STATIC_ACTION_IS_PERMANENT = "Cette action est permanente!";
$multilang_STATIC_MAN_RECORDS_INPUT_EVERY = "Enregistrements manuels doivent etre entre a un intervale (en minutes) de...";
$multilang_STATIC_MAN_RECORDS_COUNT = "Nombre d' entrees que vous souhaitez y mettre...";
$multilang_STATIC_ENTRIES_CAPS = "ENTREES";
$multilang_STATIC_BUILD_DATA_TICKET = "Construire un Ticket de donnees";
$multilang_STATIC_REVIEW_CERT = "Examen de Certification Ticket";
$multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN = "dossiers deja certifies (par n'importe quel utilisateur) ou saisies manuellement doit comparaitre avec un element en surbrillance (rouge) en fond. Ces documents ne peuvent pas etre re-certifie, car ils sont desormais verrouille. Si vous choisissez de certifier un billet ou certains dossiers qui ont deja ete certifies, votre certification ne s'appliquent pas aux documents qui n'ont pas ete prealablement certifies (ne sont pas verrouilles / pas mis en evidence).";
$multilang_STATIC_CERT_TIME_LIMIT = "documents doivent etre certifies regulierement, comme chaque quart de travail. Cependant, vous pouvez aller aussi loin que deux jours (48 heures) afin de certifier les anciens dossiers. De par leur conception, les dossiers de plus que cela ne peut etre signe, pour assurer l'integrite et l'honnetete dans le processus de signature.";
$multilang_STATIC_TICKET_COMMENT_ENTRY = "Ticket Commentaires";
$multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT = "Selectionnez les elements dans le menu defilant, puis entrez votre heure de DEBUT et de FIN. Un rapport simple doit etre affiche, qui S'auto-echelle pour la periode que vous avez selectionne. Si vous souhaitez voir plus de precision (moins de temps entre les enregistrements), il vous suffit tout simplement de choisir les temps ou DEBUT et Fin sont les plus rapproches.";
$multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF = "entrez votre heure de DEBUT et de FIN, en utilisant le menu defilant des champs.Un resume de l'activite doit etre affiche.";
$multilang_STATIC_SELECT_FROM_DROPDOWN = "Selectionnez l'element dans le menu qui defile, puis entrez votre heure de DEBUT et de Fin Un resume est affiche, couvrant cette periode de temp.";
$multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT = "Entrez votre date de commencement et l'heure, puis la longueur desiree de CAPTURE INSTANTANNEE(duree de temps depuis le debut du journal que vous souhaitez examiner).";
$multilang_STATIC_CERT_NO_COMMENTS = "Aucun commentaire n'a ete propose pour les enregistrements qui ont ete affiches.";
$multilang_STATIC_CERT_SIGNATURE_HEADER = "Certification Signature";
$multilang_STATIC_CERT_NO_SIGS = "Il n'y avait pas de SIGNATURES enregistrees pour les enregistrements qui ont ete affiches.";
$multilang_STATIC_DURATION = "DUREE";
$multilang_STATIC_DURATION_CAPS = "DUREE";
$multilang_STATIC_DURATION_IN_SECONDS = "DUREE en SECONDES";
$multilang_STATIC_DURATION_IN_SECONDS_SMALL = "Duration in Seconds";
$multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL = "Details Rundown - Systemes individuels ou de postes";
$multilang_STATIC_DETAIL_RUNDOWN_ALL = "Details Rundown - les mieux notees - Tous les Systemes ou Elements";
$multilang_STATIC_PARETO_FREQUENCY_ALL = "Pareto Analyse de la Frequence - Tous les Systemes ou Elements";
$multilang_STATIC_PARETO_DURATION_ALL = "Pareto analyse de la duree - Tous les systemes ou elements";
$multilang_STATIC_PARETO_EXPLAIN = "Analyse de Pareto parcelles doit afficher le temps total encouru pour chaque etat d'alerte ou de defaut, ainsi que la frequence (une est analysee par la duree, l'autre par frequence). Une analyse des premieres fautes individuelles peuvent etre vues dans le Les mieux notes Details Rundown, suivie d'une liste complete des alertes et des defauts pour les systemes individuels, qui sont tous classes par ordre de plus longue duree (plus d'impact).";
$multilang_STATIC_SORTING_STATUS_EXPLAIN = "etat du tri pour chaque tableau associe est indique en vert pour reussit ou 'rouge' pour le tri a echoue ... Un tri reussi est necessaire pour une identification precise de l'evenement et le temps";
$multilang_STATIC_NO_FAULTS_IN_SNAPSHOT = "Il ya eu zero (0) defauts enregistres au cours de la periode de CAPTURE INSTANTANNEE que vous avez demande.";
$multilang_STATIC_EVENT = "EVENEMENT";
$multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY = "Choisissez si vous souhaitez afficher les niveaux d'inventaire soient ACTUELS soient HISTORIQUES. Si vous choisissez HISTORIQUES, alors entrez l'heure de votre CAPTURE INSTANTANNEE. Tous les stocks connus a ce moment doivent etre affiches. Si vous choisissez ACTUEL, alors vous n'AVEZ PAS pas a entrer une heure de CAPTURE INSTANTANEE";
$multilang_STATIC_INVENTORY_TYPE = "Inventaire Type";
$multilang_STATIC_CURRENT_BLIP = "Actuel";
$multilang_STATIC_HISTORICAL_BLIP = "Historiques";
$multilang_STATIC_DATA_WITHIN_15 = "Les donnees sont effectives dans les 15 minutes de temps de vente de billets.";
$multilang_STATIC_DATESTAMP_START = "DATES TAMPON DEBUT";
$multilang_STATIC_DATESTAMP_END = "DATES TAMPON FIN ";
$multilang_STATIC_DST_NOT_IN_EFFECT = "Soyez avertis, ce serveur n'utilise pas l'heure d'ete, ou tout autre delai des moyens de decalage L'heure affichee est l'heure GMT [plus ou moins le decalage horaire ou le serveur se trouve deploye].";
$multilang_STATIC_HOLD = "MAINTENEZ";
/*			-- a interpreter comme... 'MAINTENEZ' oU 'PAUSE' */
$multilang_STATIC_STEP = "SAUTER L'ETAPE";
/*			-- a interpreter comme... 'SAUTER l'ETAPE' or 'PASSER L'ETAPE */
$multilang_STATIC_LOCKOUT_CAPS = "DESACTIVER";
/*			-- a interpreter comme... 'FERMER' or 'DESACTIVER' */
$multilang_STATIC_DISABLES_MANUAL_FUNCTIONS = "desactive les fonctions manuelles";
$multilang_STATIC_FORCE_HOLD = "Presser Pause";
$multilang_STATIC_RELEASE_HOLD = "Relacher Pause";
$multilang_STATIC_FORCE_STEP = "Forcer l'Etape";
$multilang_STATIC_LOCKOUT = "Fermeture";
$multilang_STATIC_RELEASE = "Release";
$multilang_STATIC_FAULTS_CAPS = "Defauts";
$multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE = "selectionner OUI ou NON pour 'Prise en Charge Automatique de l'echelle'... selectionner Oui, equilibre le rapport de sorte qu'il tienne sur 2 ou 3 pages (pour l'impression). Le dta totalisee (debit total /pouvoir total / etc .) sera toujours correct. Selectionner NO affichera tous les enregistrements recueillis, mais implique un rapport beaucoup plus long et plus large. Si vous selectionnez NON, alors il est fortement suggere de ne pas tenter une DUREE de CAPTURE INSTANTANEE de plus de 3 jours (72 heures ).";
$multilang_STATIC_DISPLAY = "Affichage";
$multilang_STATIC_HIDE = "Cacher";
$multilang_STATIC_SHOW_DISCRETE_ALARM_INSTANCES = "par defaut, les instances alarmes sont comptes, par pas individuellement affiche. Choisir d'afficher discrete cas d'alarme peut donner lieu a un rapport beaucoup plus.";
$multilang_STATIC_ALARMS = "Alarmes";
$multilang_STATIC_HIGH_PRECISION = "de Haute Precision";
$multilang_STATIC_EXAMINATION_WINDOW = "Examination de la duree";
/*		-- to be read as "examination window [of time]" */
$multilang_STATIC_PAGE_LOAD_TIME = "Chargement de la Page";
$multilang_STATIC_BROWSER_ENGINE = "Moteur";
$multilang_STATIC_BROWSER_NAME = "Nom";
$multilang_STATIC_BROWSER_VERSION = "Version";
$multilang_STATIC_THEME = "Theme";
$multilang_STATIC_PLUGINS = "L'extension";
$multilang_STATIC_EXPORT_PDF_HEADER = "Exporter le Rapport en tant que Fichier PDF";
$multilang_STATIC_EXPORT_PDF_DESCRIPTION = "Imprimer ce rapport sous forme de fichier PDF (pour l'archivage et le partage non controle)";

/*	-- MENU */
/*	------- */

/*	-- -- SIZE LIMITED VARIABLES */
/*	---------------------------- */
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */
$multilang_MENU_MACHINE_CONTROL = "Machine Controle";
$multilang_MENU_REPORTING = "Rapports";
$multilang_MENU_SETTINGS  = "Parametres";
$multilang_MENU_LOGIN = "Connexion";
$multilang_MENU_LOGOUT = "Deconnexion";
$multilang_MENU_HOME  = "Accueil";
$multilang_MENU_APPLICATION_DOCS  = "Application de Doc";
$multilang_MENU_ABOUT  = "A propos";
$multilang_MENU_HELP  = "Aide et support";
$multilang_MENU_COPYRIGHT  = "Copyright et Licence";
$multilang_MENU_TRAINING = "Portail de Formation";
$multilang_MENU_TECHNICAL = "Archives Technique";
$multilang_MENU_SOFTWARE = "Logiciel Archive";
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */

/*	-- -- STANDARD VARIABLES */
/*	------------------------ */
$multilang_MENU_BACK = "Retour";
$multilang_MENU_POWERED_BY = "Puissant par";
$multilang_MENU_BUILT_WITH = "Construit par";
$multilang_MENU_FOOTER_1 = "S.E.E.R. and mod_openopc sont des logiciels OPEN SOURCE pour L.A.M.P.P. and  A.M.P.P. plates-formes.";
$multilang_MENU_CONFIDENTIAL = "Toutes les donnees sont Confidentielles";
$multilang_MENU_NO_PIRATES = "Ce rapport ne peut etre utilise en tout ou en partie sans l'autorisation expresse de";
$multilang_MENU_DATACOPYRIGHTPOLICY = "La machine, appareil, ou des donnees d'equipement (y compris les resultats des calculs et des permutations base sur ces donnees) inclus dans cet affichage ou generes par cet affichage sont la propriete de la personne, personnes, organisation, entreprise ou entite ayant mis en luvre le systeme S.E.E.R Ceci, bien sur, exclut les donnees de tiers, portant leur propre licence ou droit d'auteur (par exemple, le systeme lui-meme SEER, fabricant auteur des manuels d'equipement, et d'autres liees a des fichiers).";

/*	-- SETTINGS DESCRIPTIONS */
/*	------------------------ */
$multilang_SETTINGS_USERNAME  = "NOM D'UTILISATEUR"; 
$multilang_SETTINGS_USERNAME_D  = "un unique nom d'utilisateur "; 
$multilang_SETTINGS_REALNAME  = "NOM REEL"; 
$multilang_SETTINGS_REALNAME_D  = "veritable nom et prenom, d'utilisateur"; 
$multilang_SETTINGS_PASSWORD = "MOT DE PASSE"; 
$multilang_SETTINGS_PASSWORD_D  = "mot de passe pour l'acces"; 
$multilang_SETTINGS_PHONE  = "TELEPHONE"; 
$multilang_SETTINGS_PHONE_D  = "numero de telephone de l'utilisateur, ou AUCUN"; 
$multilang_SETTINGS_EMAIL = "EMAIL"; 
$multilang_SETTINGS_EMAIL_D  = "adresse e-mail de l'utilisateur, ou AUCUN"; 
$multilang_SETTINGS_COMPANY = "ENTREPRISE";
$multilang_SETTINGS_COMPANY_D  = "nom de l'entreprise, par exemple, 'Lactalis American Group'";
$multilang_SETTINGS_SHIFT = "POSTE"; 
$multilang_SETTINGS_SHIFT_D  = "poste de travail utilisateur"; 
$multilang_SETTINGS_SITE = "SITE"; 
$multilang_SETTINGS_SITE_D  = "site de l'entreprise, par exemple, 'Sorrento (Buffalo, NY)'"; 
$multilang_SETTINGS_DEPARTMENT = "DEPARTEMENT"; 
$multilang_SETTINGS_DEPARTMENT_D  = "service de l'entreprise, par exemple 'Mozzarella Production'"; 
$multilang_SETTINGS_SUPERVISOR = "SUPERVISEUR"; 
$multilang_SETTINGS_SUPERVISOR_D  = "nom d'utilisateur du superviseur de cet utilisateur"; 
$multilang_SETTINGS_ACCESS_LEVEL = "NIVEAU D'ACCES"; 
$multilang_SETTINGS_ACCESS_LEVEL_D  = "niveau d'acces utilisateur"; 
$multilang_SETTINGS_ACCESS_STATE = "ACCEDER A L'ETAT"; 
$multilang_SETTINGS_ACCESS_STATE_D  = "etat d'acces de l'utilisateur";
$multilang_SETTINGS_COMMIT_USER_ADD = "Valider un Ajout d'Utilisateur";
$multilang_SETTINGS_ACCESS_GRANTED = "ACCES AUTORISE";
$multilang_SETTINGS_ACCESS_GRANTED_BY = "ACCES ACCORDE PAR";
$multilang_SETTINGS_LAST_MODIFIED = "DERNIERE MODIFICATION";
$multilang_SETTINGS_LAST_MODIFIED_BY = "DERNIERE MODIFICATION PAR";
$multilang_SETTINGS_LAST_LOGIN = "DERNIERE CONNECTION";
$multilang_SETTINGS_LAST_ACTIVITY = "DERNIERE ACTIVITE";
$multilang_SETTINGS_HASH_KEY  = "DIESE";
$multilang_SETTINGS_REMOVE_SINGLE_USER = "Supprimer un Seul Utilisateur";
$multilang_SETTINGS_COMMIT_USER_REMOVE = "Valider Retirer un Utilisateur";
$multilang_SETTINGS_REMOVE_GROUP_OF_USERS  = "Supprimer un Groupe d'Utilisateurs";
$multilang_SETTINGS_GROUP_ID_BY  = "Groupe identifies par ...";
$multilang_SETTINGS_COMMIT_GROUP_REMOVE = "Valider Supprimer un Groupe";
$multilang_SETTINGS_COMMIT_USER_CHANGES = "Valider les Modifications de l'Utilisateur";
$multilang_SETTINGS_INSTALLERS_ONLY = "INSTALLATEURS SEULEMENT";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_1 = "A UTILISER AVEC UNE PRUDENCE EXTREME!";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_2 = "IL N'Y PAS DE RECUPERATION A PARTIR DE CE POINT!";
$multilang_SETTINGS_INITIAL_INSTALLATION = "Installation Initiale";
$multilang_SETTINGS_WARNING_ERASES_ALL_DATA = "ATTENTION: efface TOUTES les donnees.";
$multilang_SETTINGS_CREATE_BASIC_DATABASE = "creation de base de donnee basique a partir de zero";
$multilang_SETTINGS_DESTROY_DATABASE = "detruit la base de donnees existante et toutes les donnees";
$multilang_SETTINGS_CREATE_TRAINING_PORTAL_DATABASE = "cree un portail d'instruction de base de donnees a partir de zero";
$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE = "cree un Modele de Base de la table";
$multilang_SETTINGS_ADMINISTRATORS_ONLY = "ADMNISTRATEURS SEULEMENT";
$multilang_SETTINGS_CORE_MODEL_SETUP = "INSTALLER UN MODELE DE BASE";
$multilang_SETTINGS_SUPER_USERS_ONLY = "SUPER UTILISATEURS SEULEMENT";
$multilang_SETTINGS_ADD_AND_REMOVE_USERS = "Ajouter et supprimer des utilisateurs";
$multilang_SETTINGS_ADD_SYSTEM_USERS = "ajouter des utilisateurs du systeme";
$multilang_SETTINGS_REMOVE_SYSTEM_USERS = "supprimer des utilisateurs du systeme";
$multilang_SETTINGS_LOCKDOWN_CONTROL = "DESACTIVER le Controle";
$multilang_SETTINGS_LOCKDOWN_IN_EFFECT = "Tous les utilisateurs du systeme avec un niveau acces en dessous de 2 (Super Utilisateur) ont ete exclus du systeme Merci.";
$multilang_SETTINGS_LOCKDOWN_RELEASED = "Tous les utilisateurs du systeme avec un niveau acces en dessous 2 (Super Utilisateur) sont retournes a leur RANG D'ACCES precedent Merci.";
$multilang_SETTINGS_LOCKDOWN_ENABLE_ACCESS = "permettre l'acces, retour des utilisateurs au statut d'acces precedent";
$multilang_SETTINGS_LOCKDOWN_DISABLE_ACCESS = "desactiver tous les utilisateurs- fermer tous les acces";
$multilang_SETTINGS_LEAD_PERSONS_ONLY = "LEADER seulement";
$multilang_SETTINGS_MODIFY_USER_ACCESS_AND_INFORMATION = "Modifier l'Acces des utilisateurs et Information";
$multilang_SETTINGS_DISPLAY_ALL_USERS = "afficher tous les utilisateurs du systeme";
$multilang_SETTINGS_DISPLAY_SITE_USERS = "afficher tous les utilisateurs enregistres sur votre SITE";
$multilang_SETTINGS_DISPLAY_DEPARTMENT_USERS = "afficher tous les utilisateurs enregistres a VOTRE DEPARTMENT";
$multilang_SETTINGS_DISPLAY_SHIFT_USERS = "afficher tous les utilisateurs enregistres sur votre TOUR DE GARDE";
$multilang_SETTINGS_OPERATORS_ONLY = "OPERATEURS SEULEMENT";
$multilang_SETTINGS_CHANGE_YOUR_PASSWORD = "Changer Votre Mot de passe Systeme";
$multilang_SETTINGS_PASSWORD_UPDATED = "Votre mot de passe a ete mis a jour Merci.";
$multilang_SETTINGS_OLD_PASSWORD = "ancien mot de passe";
$multilang_SETTINGS_NEW_PASSWORD = "nouveau mot de passe";
$multilang_SETTINGS_DATA_FRESH_AS_OF = "Donnees rafraichies tel que";
$multilang_SETTINGS_SUPERVISORS_ONLY = "SUPERVISEURS SEULEMENT";
$multilang_SETTINGS_MANAGERS_ONLY = "DIRECTEURS SEULEMENT";

/*	-- FAULTS */
/*	--------- */
$multilang_FAULT_1 = "NIVEAU D'ACCES insuffisant pour afficher cette page.";
$multilang_FAULT_2 = "manque une variable - 'ANNEE DEBUT'";
$multilang_FAULT_3 = "manque une variable - 'MOIS DU DEBUT'";
$multilang_FAULT_4 = "manque une variable - 'JOUR DU DEBUT'";
$multilang_FAULT_5 = "manque une variable - 'HEURE DU DEBUT'";
$multilang_FAULT_6 = "manque une variable - 'MINUTE DEBUT'";
$multilang_FAULT_7 = "manque une variable - 'ANNEE FIN'";
$multilang_FAULT_8 = "manque une variable - 'MOIS FIN'";
$multilang_FAULT_9 = "manque une variable - 'JOUR FIN'";
$multilang_FAULT_10 = "manque une variable - 'HEURE FIN'";
$multilang_FAULT_11 = "manque une variable - 'MINUTE FIN'";
$multilang_FAULT_12 = "Affichage des Echecs ou Pannes";
$multilang_FAULT_13 = "nous avons rencontre un defaut du traitement de l'information que vous avez fourni.";
$multilang_FAULT_14 = "parmis les causes courantes de donnees vides ou manquantes,les listes deroulantes laissee en blanc, le systeme ne tiendra pas compte des erreurs, en sautant les 'mauvais' dossiers, et affichera seulement les bonnes.";
$multilang_FAULT_15 = "Les fautes constatees comme";
/*			-- to be read as... 'Fault Registered As [some fault]' */
$multilang_FAULT_16 = "Administrateur ou Super Utilisateur Acquittement des Failles";
$multilang_FAULT_17 = "Effacer toutes les Fautes Actives";
$multilang_FAULT_18 = "Failles Actuelles et A ET Notifications";
$multilang_FAULT_19 = "Historique des Recherches de panne";
$multilang_FAULT_20 = "Remedier a une faute ne la supprimera pas du systeme. Il la poussera simplement dans l'historique, ou n'importe quel utilisateur peut ensuite visualiser toutes les failles enregistrees entre une periode donnee (ainsi que le nom de quiconque a autorise ces fautes).";
$multilang_FAULT_21 = "une fois que l'ADMINISTRATEUR SYSTEME a corrige la cause des defauts, un administrateur ou super utilisateur peut alors effacer les fautes, en utilisant un formulaire qui apparaitra en dessous de toutes failles actives. Ce formulaire est uniquement visible aux utilisateurs niveau 2 et niveau 1, alors ne vous inquietez pas si vous ne le voyez pas.";
$multilang_FAULT_22 = "S.E.E.R.est amene a la vie par un reseau de donnees d'entree et de sortie du systeme autonome (mod_openopc). Dans le cas d'un probleme, une erreur sera renvoyee par l'ossature et enregistre dans le stockage de donnees. Tous les defauts ACTUELLEMENT ACTIFS sont enumeres ci-dessous.";
$multilang_FAULT_23 = "manque une variable - 'TYPE DE FICHIER'";
$multilang_FAULT_24 = "manque une variable - 'CATEGORIE DE FICHIER'";
$multilang_FAULT_25 = "manque une variable - 'FICHIER DES VENDEURS oU SITE'";
$multilang_FAULT_26 = "manque une variable - 'NOM DU FICHIER'";
$multilang_FAULT_27 = "manque une variable - 'REVISION DU FICHIER'";
$multilang_FAULT_28 = "manque une variable - 'EXTENSION DU FICHIER'";
$multilang_FAULT_29 = "EXISTE DEJA sur le seveur. Vous ne pouver pas ecraser (Ceci ne devrait jamais se produire, a moins que l'horloge du serveur ai ete intentionnellement modifie illegalement pour forcer l'ecrasement.).";
$multilang_FAULT_30 = "La publication sur le serveur a echoue.";
/*			-- to be read as... '[something] FAILED TO POST to the server.' */
$multilang_FAULT_31 = "A ete Telecharge vers le serveur.";
/*			-- to be read as... '[something] was successfully uploaded to the server.' */
$multilang_FAULT_32 = "Le NOM D'UTILISATEUR choisi existe deja! Si vous souhaitez ajouter un nouvel enregistrement, vous devez d'abord supprimer l'utilisateur existant.";
$multilang_FAULT_33 = "Tous les champs variable utilisateur doivent etre rempli en entier avant que l'utilisateur puisse etre ajoute.Veuillez reexaminer le formulaire, remplissez-le et renvoyez-le.";
$multilang_FAULT_34 = "vOUS N'etes pas CONNECTE. Vous devez etre un UTILISATEUR AUTORISE DU SYSTEM pour acceder a cette page.";
$multilang_FAULT_35 = "Defaillance du systeme.Veuillez contacter un ADMINISTRATEUR si ceci persiste.";
$multilang_FAULT_36 = "Environment INCONNU Application";
$multilang_FAULT_37 = "Ceci est innacceptable.Voir le dossierr -globaloptions_seer_0- pour plus d'informations.";
$multilang_FAULT_38 = "manque une variable - 'SELECTION CAPTURE INSTANTANNEE'";
$multilang_FAULT_39 = "Aucune donnee n'est disponible pour le temp choisi de CAPTURE INSTANTANNEE. Si vous avez choisi en cours, alors le systeme peut ne pas fonctionner (veuillez contactez un administrateur), ou alors, vous avez entre une heure incorrecte dansl'HISTORIQUE, ou le systeme ne fonctionnait pas pourle temps que vous avez selectionne.";
$multilang_FAULT_40 = "manque une variable - 'DEBUT DATES TAMPON'";
$multilang_FAULT_41 = "manque une variable - 'FIN DATES TAMPON'";
$multilang_FAULT_42 = "manque une variable - 'ENTREE COMMENTAIRE'";
$multilang_FAULT_43 = "manque une variable - 'ECHELLE AUTOMATIQUE DU RAPPORT'";
$multilang_FAULT_44 = "Il n'y avait aucune activite enregistree EN cours lors du temps de CAPTURE INSTANTANNEE que vous avez demande...";
$multilang_FAULT_45 = "Meme les systemes de cet EXEMPLE etaient hors service pour la periode demandee, OU, vous pouvez avoir choisi une date dans le futur.";
$multilang_FAULT_46 = "Les fonctions de nettoyage CIP, enumeres ci-dessus, s'appliquent uniquement a l'equipement et des machines qui sont AUTO-NETTOYANTE.Les informations CIP de nettoyage pour tous les autres equipements peuvent etre visualises a l'aide des rapports generes par le modele CIP, et l'acces au systeme de nettoyage approprie.";
$multilang_FAULT_47 = "Le modele en question n'est pas active sur ce sytem.";
$multilang_FAULT_48 = "La base de donnees est protegee WORM.";

/*      -- INSTALLATION */ 
/*      -------- */ 
$multilang_SETUP_0 = "INSTALLATION D'UNE BASE DE DONNEES"; 
$multilang_SETUP_1 = "Nous avons rencontre une erreur!"; 
$multilang_SETUP_2 = "Il semble que l'une des conditions suivantes soit remplie, et nous permet de mettre en place la base de donnees ou une table ..."; 
$multilang_SETUP_3 = "- la base de donnees ou une table a deja ete cree et existe toujours."; 
$multilang_SETUP_4 = "- Vous avez entre les informations d'identification incorrecteS ou mot de passe errone pour la base de donnees MySQL."; 
$multilang_SETUP_5 = "- vous avez entre une adresse incorrecte IP ou le mauvais nom de base de donnees MySQL."; 
$multilang_SETUP_6 = "S'il vous plait consulter votre dossier-globaloptions_seer_0 et demandez a votre administrateur d'examiner la base de donnees via la console si necessaire."; 
$multilang_SETUP_7 = "Ne pas quitter cette page!"; 
$multilang_SETUP_8 = "Lisez le message ci-dessous, et vous serez renvoye au menu SETUP en 90 secondes."; 
$multilang_SETUP_9 = "La base de donnees devrait maintenant etre installe et prete a utiliser. Vous pouvez verifier cela en ouvrant MySQL via la console et poser les requetes suivantes ..."; 
$multilang_SETUP_10 = "sortie doit comprendre"; 
$multilang_SETUP_11 = "Si les resultats ci-dessus ne sont pas presents, alors reexaminer votre fichier globaloptions_seer_0."; 
$multilang_SETUP_12 = "Si vous avez deja installe la table de base de donnees, alors vous devez le supprimer avant de pouvoir l'installer a nouveau."; 
$multilang_SETUP_13 = "DETRUIRE Base de Donnees"; 
$multilang_SETUP_14 = "La base de donnees devrait desormais etre detruite et retiree. Vous pouvez verifier cela en ouvrant MySQL via la console et de poser les requetes suivantes ..."; 
$multilang_SETUP_15 = "sortie ne doit pas comprendre"; 
$multilang_SETUP_16 = "sortie doit comprendre seulement l'utilisateur par defaut"; 
$multilang_SETUP_17 = "L'informations sur votre connexion par defaut est la suivante ..."; 
$multilang_SETUP_18 = "ADMINISTRATEUR PAR DEFAUT"; 
$multilang_SETUP_19 = "MOT DE PASSE PAR DEFAUT"; 
$multilang_SETUP_20 = "Vous devez modifier cA des que possible en vous connectant, puis changer ensuite le mot de passe dans le menu INSTALLATION."; 

/* PHPSYSINFO */
/* ------------------------------------------------------------------ */
$multilang_PHPSYSINFO_0 = "Information Systeme";
$multilang_PHPSYSINFO_1 = "Systeme Essentiel";
$multilang_PHPSYSINFO_2 = "Nom d'hote Canonique";
$multilang_PHPSYSINFO_3 = "Ecoute IP";
$multilang_PHPSYSINFO_4 = "Version Kernel";
$multilang_PHPSYSINFO_5 = "Nom Distro";
$multilang_PHPSYSINFO_6 = "Duree de Fonctionnement";
$multilang_PHPSYSINFO_7 = "Utilisateur Actuel";
$multilang_PHPSYSINFO_8 = "Moyennes des Chargements";
$multilang_PHPSYSINFO_9 = "Informations sur le Materiel";
$multilang_PHPSYSINFO_10 = "Processeurs";
$multilang_PHPSYSINFO_11 = "Modele";
$multilang_PHPSYSINFO_12 = "Vitesse CPU";
$multilang_PHPSYSINFO_13 = "Vitesse BUS";
$multilang_PHPSYSINFO_14 = "Taille du Cache";
$multilang_PHPSYSINFO_15 = "Systeme Bogomips";
$multilang_PHPSYSINFO_16 = "Peripherique PCI";
$multilang_PHPSYSINFO_17 = "Peripherique IDE";
$multilang_PHPSYSINFO_18 = "Peripherique SCSI";
$multilang_PHPSYSINFO_19 = "Peripherique USB";
$multilang_PHPSYSINFO_20 = "Utilisation du Reseau";
$multilang_PHPSYSINFO_21 = "Peripherique";
$multilang_PHPSYSINFO_22 = "Recu";
$multilang_PHPSYSINFO_23 = "Envoyes";
$multilang_PHPSYSINFO_24 = "Err/Abandon";
/*                      -- A lire que... '[Abreviation de] Erreurs/Abandon [paquets]' */
$multilang_PHPSYSINFO_25 = "Etablissement de Connexions Reseau";
$multilang_PHPSYSINFO_26 = "Utilisation de la Memoire";
$multilang_PHPSYSINFO_27 = "Memoire Physique";
$multilang_PHPSYSINFO_28 = "Echange de disque";
$multilang_PHPSYSINFO_29 = "Fichiers Systemes montes";
$multilang_PHPSYSINFO_30 = "Montage";
$multilang_PHPSYSINFO_31 = "Partition";
$multilang_PHPSYSINFO_32 = "Capacite en Pourcentage";
$multilang_PHPSYSINFO_33 = "Type";
$multilang_PHPSYSINFO_34 = "Libre";
$multilang_PHPSYSINFO_35 = "Utilise";
$multilang_PHPSYSINFO_36 = "Taille";
$multilang_PHPSYSINFO_37 = "Totaux";
$multilang_PHPSYSINFO_38 = "KB";
/*			-- to be read as... '[abbreviation for] Kilobytes' */
$multilang_PHPSYSINFO_39 = "MB";
/*			-- to be read as... '[abbreviation for] Megabytes' */
$multilang_PHPSYSINFO_40 = "GB";
/*			-- to be read as... '[abbreviation for] Gigabytes' */
$multilang_PHPSYSINFO_41 = "Aucun";
$multilang_PHPSYSINFO_42 = "Capacite"; 
$multilang_PHPSYSINFO_43 = "Modele";
$multilang_PHPSYSINFO_44 = "Langue";
$multilang_PHPSYSINFO_45 = "Envoyer";
$multilang_PHPSYSINFO_46 = "Cree par";
$multilang_PHPSYSINFO_47 = "en_US";
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_47 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_48 = "%b %d, %Y @ %I:%M %p";
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_48 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_49 = "jours";
$multilang_PHPSYSINFO_50 = "heures";
$multilang_PHPSYSINFO_51 = "minutes";
$multilang_PHPSYSINFO_52 = "Temperature";
$multilang_PHPSYSINFO_53 = "Voltage";
$multilang_PHPSYSINFO_54 = "Ventilateurs";
$multilang_PHPSYSINFO_55 = "Valeur";
$multilang_PHPSYSINFO_56 = "Min";
/*			-- to be read as... '[abbreviation for] Minimum' */
$multilang_PHPSYSINFO_57 = "Max";
/*			-- to be read as... '[abbreviation for] Maximum' */
$multilang_PHPSYSINFO_58 = "Hysterese";
$multilang_PHPSYSINFO_59 = "Limite";
$multilang_PHPSYSINFO_60 = "Label";
$multilang_PHPSYSINFO_61 = "C";
/*			-- to be read as... '[abbreviation for] Celsius' */
$multilang_PHPSYSINFO_62 = "F";
/*			-- to be read as... '[abbreviation for] Farenheit' */
$multilang_PHPSYSINFO_63 = "V";
/*			-- to be read as... '[abbreviation for] Voltage' */
$multilang_PHPSYSINFO_64 = "RPM";
/*			-- to be read as... '[abbreviation for] Rotations per Minute' */
$multilang_PHPSYSINFO_65 = "Noyau & Applications";
$multilang_PHPSYSINFO_66 = "Tampon";
$multilang_PHPSYSINFO_67 = "Mis en Cache";
$multilang_PHPSYSINFO_68 = "deg";
/*			-- to be read as... '[abbreviation for] degrees' */

/* MODOPENOPC PLUGINS */
/* ------------------------------------------------------------------ */
$multilang_MODOPENOPC_SUCCESS = "REUSSITE";
$multilang_MODOPENOPC_FAILURE = "ECHEC";
$multilang_MODOPENOPC_OPERATION_TYPE = "TYPE D'OPERATION";
$multilang_MODOPENOPC_DAEMON_FILE_CREATION = "... cas de creation de fichier par S.E.E.R. integration builtin.";
$multilang_MODOPENOPC_READ_DAEMON_FUNCTION_PRESET = "Toutes les fonctions READ_DAEMON sont un PREREGLAGE de base.";
$multilang_MODOPENOPC_DATESTAMP = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_MODOPENOPC_CURRENT_DATESTAMP = "La date systeme et l'heure sont";
$multilang_MODOPENOPC_ACTION_DATA = "RESULTATS DES ACTIONS";
/*			-- to be read as... 'ACTION DATA' or 'RESULTS OF ACTION' */
$multilang_MODOPENOPC_SEER_AUTO_GENERATED = "Ce rapport d'action a ete genere automatiquement par le S.E.E.R.";
$multilang_MODOPENOPC_DEBUG = "DONNEES DE DEBOGAGE";
$multilang_MODOPENOPC_ERROR = "ERREUR!";
$multilang_MODOPENOPC_BAD_INPUT = "MAUVAISE FORME D'ENTREE DE DONNE";
$multilang_MODOPENOPC_BAD_INPUT_REASON = "Ceci est generalement cause par une une page referante du web malformee. Veuillez fermer votre navigateur, revenir a la page ou vous etiez, et recommencez la meme operation a nouveau. Si vous obtenez cette erreur plus d'une fois, alors vous devrez prendre les mesures suivantes:";
$multilang_MODOPENOPC_BAD_INPUT_REASON_1 = "Notez l'adresse de la page ou vous venez d'aller.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_2 = "Imprimer cette page afin de disposer d'une trace  des donnees ci-dessous.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_3 = "Contactez votre administrateur systeme avec ces informations.";
$multilang_MODOPENOPC_BAD_INPUT_REASON_4 = "Ne pas continuer a tenter de forcer de nouveau cette operation.";
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Ce type d'ecriture en utilisant cette fonction devrait etre PREETABLIE.";
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Ce type d'ecriture en utilisant cette fonction doit etre DECLAREE.";


/* MODEL LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/*	-- TANKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TANKMODEL_0 = "MODELE DE RESERVOIR";
$multilang_TANKMODEL_1 = "Moniteur Principal";
$multilang_TANKMODEL_2 = "Declancheur de mise en Marche de l'Ecran";
$multilang_TANKMODEL_3 = "Manuel d'Enregistrement d'Entree";
$multilang_TANKMODEL_4 = "Certification d'Enregistrement";
$multilang_TANKMODEL_5 = "Diminution d'Agitation";
$multilang_TANKMODEL_6 = "Diagrame de Temperature";
$multilang_TANKMODEL_7 = "Diagrame des Niveaux";
$multilang_TANKMODEL_8 = "Inventaire des Produits";
$multilang_TANKMODEL_9 = "Occupation du Reservoir";
$multilang_TANKMODEL_10 = "Historique des Alarmes";
$multilang_TANKMODEL_11 = "Activite de Gantt";
$multilang_TANKMODEL_12 = "COMMUNIQUE DE VEROUILLAGE DU NETTOYAGE DE RESERVOIR";
$multilang_TANKMODEL_13 = "Identification de Reservoir";
$multilang_TANKMODEL_14 = "Communique de Sortie?";
/*			-- to be read as... '[shall we] Release [this tank]?' */
$multilang_TANKMODEL_15 = "Reservoir ou Silo";
$multilang_TANKMODEL_16 = "Controle du Verouillage";
/*			-- to be read as... '[system] Lockdown Control' */
$multilang_TANKMODEL_17 = "MODIFIE LES PARAMETRES DU RESERVOIR";
$multilang_TANKMODEL_18 = "Nouvelle Valeur";
$multilang_TANKMODEL_19 = "Densite";
$multilang_TANKMODEL_20 = "Produit";
$multilang_TANKMODEL_21 = "Declancheur ON des Valeurs";
/* 			-- to be read as... 'Agitator [to turn] ON [at product] Level [in percent]' */
$multilang_TANKMODEL_22 = "Niveau";
/*			-- to be read as... 'Level [in tank]' */
$multilang_TANKMODEL_23 = "Declancheur OFF des valeurs";
/*			-- to be read as... 'Agitator [to turn] OFF [at product] Level [in percent]' */
$multilang_TANKMODEL_24 = "Reservoir dans le Groupe";
$multilang_TANKMODEL_25 = "Declancheur du Mode";
$multilang_TANKMODEL_26 = "Declancheur du Prereglage";
/*			-- to be read as... 'Agitator Preset [or Recipe]' */
$multilang_TANKMODEL_27 = "Groupe de Prereglage";
/*			-- to be read as... 'Group Preset [or Recipe]' */
$multilang_TANKMODEL_28 = "Declancheur de Vitesse";
$multilang_TANKMODEL_29 = "MODIFICATION DES PARAMETRES DU RESERVOIR OU SILO";
$multilang_TANKMODEL_30 = "DECLANCHEUR DU RAPPORT DE PREREGLAGE";
$multilang_TANKMODEL_31 = "Declancheur du Groupe d'ID";
$multilang_TANKMODEL_33 = "Prereglage du Nom";
$multilang_TANKMODEL_34 = "Haute Vitesse";
$multilang_TANKMODEL_35 = "Basse Vitesse";
$multilang_TANKMODEL_37 = "VITESSE UNIQUE";
$multilang_TANKMODEL_40 = "Reservoir";
$multilang_TANKMODEL_42 = "HEURE du Dernier Nettoyage";
/*			-- to be read as... 'HRS [Hours] Since [Tank was] Clean[ed]' */
$multilang_TANKMODEL_43 = "Source";
$multilang_TANKMODEL_44 = "Destination";
$multilang_TANKMODEL_45 = "Volume";
$multilang_TANKMODEL_46 = "Masse";
$multilang_TANKMODEL_47 = "NIVEAU DE REMPLISSAGE";
/*			-- to be read as... 'FILL [or LEVEL in percent]' */
$multilang_TANKMODEL_48 = "TEMP.";
/*			-- to be read as... 'TEMP [abbreviation for TEMPERATURE in degrees] */
$multilang_TANKMODEL_51 = "VARIABLE Fabricant & Modele";
/*			-- to be read as... '[Variable Frequency] Drive Manufacturer and Model [Number]' */
$multilang_TANKMODEL_52 = "L'affichage de letat HTTP du mode s'ouvrira dans une autre fenetre. Lorsque vous souhaitez revenir a S.E.E.R, il vous suffit de fermer la fenetre nouvellement creee.";
$multilang_TANKMODEL_53 = "selectionnez le mode de votre agitateur de reservoir a frequence variable ";
$multilang_TANKMODEL_54 = "Ce sous-modele ne dispose pas du controle de l'agitation.C'est generalement parce que les agitateurs inclus dans le modele ne dispose pas du controle dynamique de la vitesse donc, cet ecran ne peut pas etre affichee.";
$multilang_TANKMODEL_65 = "ETAT DU RESERVOIR";
$multilang_TANKMODEL_70 = "Selectionnez votre reservoir ou silo dans le menu deroulant, puis entrez votre heure de depart pour la saisie manuelle. Chaque entree ulterieure de DATES-TAMPON sera automatiquement incremente par l'intervalle requis...";
$multilang_TANKMODEL_75 = "manque une variable - 'NOM DU RESERVOIR'"; 
$multilang_TANKMODEL_78 = "Machine";
$multilang_TANKMODEL_88 = "Selectionnez votre reservoir a partir du menu deroulant, puis entrez une plage de temps DEBUT et de FIN. Tous les enregistrements  disponibles pour la certification seront affichee pour vous.";
$multilang_TANKMODEL_92 = "Etat";
$multilang_TANKMODEL_93 = "Niveau d'Activation SUR / OFF";
$multilang_TANKMODEL_95 = "ETAT";
$multilang_TANKMODEL_96 = "HEURE DU DERNIER NETTOYAGE";
/*			-- to be read as... 'HRS [Hours] SINCE [Tank was] CLEAN[ED]' */
$multilang_TANKMODEL_97 = "Temperature";
$multilang_TANKMODEL_105 = "RESERVOIR";
$multilang_TANKMODEL_107 = "PRODUIT";
$multilang_TANKMODEL_108 = "OCCUPATIONS DISCRETE";
$multilang_TANKMODEL_109 = "MASSE";
$multilang_TANKMODEL_110 = "VOLUME";
$multilang_TANKMODEL_116 = "tout produit qui se trouve dans un reservoir 'Vide', ou a un niveau d'inventaire positif enumeres dans la rubrique a vide, doit etre considere <B><I> Inconnu </I></B> Le type de produit est entre manuellement par les operateurs de machine toute la journee;Un produit present dans un reservoir'vide' est generalement une erreur de l'operateur (l' oubli de changer le type de produit dans le reservoir apres avoir commence un remplissage).";
$multilang_TANKMODEL_117 = "Repartition par Produit";
$multilang_TANKMODEL_118 = "POUCENTAGE de l'INVENTAIRE TOTAL";
$multilang_TANKMODEL_119 = "STOCKES dans les RESERVOIRS";
$multilang_TANKMODEL_120 = "MASSE TOTALE";
$multilang_TANKMODEL_121 = "VOLUME TOTALE";
$multilang_TANKMODEL_122 = "Distribution par Reservoirs";
$multilang_TANKMODEL_123 = "POURCENTAGE de l'INVENTAIRE des PRODUITS";
$multilang_TANKMODEL_124 = "Defaillance du Confinement";
$multilang_TANKMODEL_125 = "seuls les enregistrements indiquant un niveau de produit au-dessus du niveau minimum appreciables sont affichees. Niveau minimum appreciable";
$multilang_TANKMODEL_126 = "determination de la defaillance du confinement est basee sur la temperature du produit en dehors de la plage acceptable, qui est definie comme";
$multilang_TANKMODEL_127 = "que les echecs de confinement couvrant superieur au seuil de rupture minimale sont affichees. Le seuil de l'echec est minime";
$multilang_TANKMODEL_128 = "Dump de Base de Donnees";
$multilang_TANKMODEL_129 = "Base de donnees de vidage est terminee. Vous pouvez acceder au telechargement a l'aide à l'exportation et sur ​​le bouton Enregistrer ci-dessus.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TANKMODEL_32 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_TANKMODEL_36 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TANKMODEL_38 = $multilang_STATIC_CURRENT_TIME;
$multilang_TANKMODEL_39 = $multilang_TANKMODEL_32;
$multilang_TANKMODEL_41 = $multilang_STATIC_ALARMS;
$multilang_TANKMODEL_49 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_TANKMODEL_50 = $multilang_STATIC_DISPLAY;
$multilang_TANKMODEL_55 = $multilang_TANKMODEL_2;
$multilang_TANKMODEL_56 = $multilang_TANKMODEL_3;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_57 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_TANKMODEL_58 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_TANKMODEL_59 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_TANKMODEL_60 = $multilang_STATIC_CERT_STAMP;
$multilang_TANKMODEL_61 = $multilang_STATIC_CERT_COMMENT;
$multilang_TANKMODEL_62 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_TANKMODEL_63 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_TANKMODEL_64 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_71 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_TANKMODEL_72 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TANKMODEL_73 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_TANKMODEL_74 = $multilang_TANKMODEL_4;
$multilang_TANKMODEL_76 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_TANKMODEL_77 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_TANKMODEL_79 = $multilang_STATIC_SERVER;
$multilang_TANKMODEL_80 = $multilang_STATIC_DB_TABLE;
$multilang_TANKMODEL_81 = $multilang_STATIC_DATE_RANGE;
$multilang_TANKMODEL_82 = $multilang_STATIC_YOUR_USERNAME;
$multilang_TANKMODEL_83 = $multilang_STATIC_RERUN_REPORT;
$multilang_TANKMODEL_84 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_TANKMODEL_85 = $multilang_STATIC_REVIEW_CERT;
$multilang_TANKMODEL_86 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_TANKMODEL_87 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_TANKMODEL_89 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_TANKMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_TANKMODEL_91 = $multilang_TANKMODEL_5;
$multilang_TANKMODEL_94 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_TANKMODEL_98 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_TANKMODEL_99 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_TANKMODEL_100 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_TANKMODEL_101 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_TANKMODEL_102 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_TANKMODEL_103 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_TANKMODEL_104 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_TANKMODEL_106 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_TANKMODEL_111 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_TANKMODEL_112 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_TANKMODEL_113 = $multilang_STATIC_CURRENT_BLIP;
$multilang_TANKMODEL_114 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_TANKMODEl_115 = $multilang_STATIC_DATA_WITHIN_15;
/*			-- do not edit this block unless modifying program */

/*	-- SPFMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_SPFMODEL_0 = "SPF MODELE";
/*		-	-- where SPF stands for 'SEPARATION, PASTEURIZATION, and FILTRATION' */
$multilang_SPFMODEL_1 = "Moniteur principal";
$multilang_SPFMODEL_2 = "Reglage Machine";
$multilang_SPFMODEL_3 = "Manuel d'Enregistrement des Entrees";
$multilang_SPFMODEL_4 = "Certificat d'Enregistrement";
$multilang_SPFMODEL_5 = "Sommaire de la Production";
$multilang_SPFMODEL_6 = "Utilisation de l'Energie";
$multilang_SPFMODEL_7 = "Charte de Turbidite des Egouts ";
$multilang_SPFMODEL_8 = "Analyses de la Production";
/* $multilang_SPFMODEL_9 -- DELETED */
$multilang_SPFMODEL_10 = "CIP Consommation d'Eau";
$multilang_SPFMODEL_11 = "CIP Charte de Temperature";
$multilang_SPFMODEL_12 = "CIP Charte des Performances Optimales";
$multilang_SPFMODEL_13 = "Historique des Alarmes";
$multilang_SPFMODEL_14 = "Activite de Gantt";
$multilang_SPFMODEL_15 = "Machine_ID";
/*			-- to be read as... 'Machine_[Identification - abbreviation]' */
$multilang_SPFMODEL_16 = "Type";
$multilang_SPFMODEL_18 = "HEURES du Dernier Nettoyage";
$multilang_SPFMODEL_19 = "Auto Nettoyage de Machine";
$multilang_SPFMODEL_20 = "Etape CIP";
$multilang_SPFMODEL_21 = "Type d'Eau";
$multilang_SPFMODEL_22 = "Utilisation de l'eau";
$multilang_SPFMODEL_23 = "TEMP.";
$multilang_SPFMODEL_24 = "DEBIT";
$multilang_SPFMODEL_25 = "CIP par une Autre Source";
$multilang_SPFMODEL_26 = "Cette machine est nettoyee par une autre machine, ou par un systeme de lavage CIP. Veuillez vous referer aux sources suivantes pour obtenir des renseignements concernant le statut ou l'historique de cette machine de nettoyage ...";
$multilang_SPFMODEL_27 = "Source";
$multilang_SPFMODEL_28 = "Destination_1";
$multilang_SPFMODEL_29 = "Destination_2";
$multilang_SPFMODEL_30 = "DEBIT de la Source";
$multilang_SPFMODEL_31 = "Dest_1 DEBIT";
$multilang_SPFMODEL_32 = "Dest_2 DEBIT";
$multilang_SPFMODEL_33 = "Taux de la Puissance";
$multilang_SPFMODEL_34 = "Turbidite de l'Egout";
$multilang_SPFMODEL_35 = "Reconnaissance de l'Alarme de Turbidite";
$multilang_SPFMODEL_36 = "Vitesse du Bol";
$multilang_SPFMODEL_37 = "TEMP. d'Entree";
$multilang_SPFMODEL_38 = "TEMP. de Pasterisation";
$multilang_SPFMODEL_39 = "PREMIERE PRESSION";
$multilang_SPFMODEL_40 = "PRESSION DE Pasteurisation";
$multilang_SPFMODEL_41 = "Ligne de Base PRESSION";
/*			-- to be read as '[abbreviation for] Baseline PRESS[URE]' */
$multilang_SPFMODEL_42 = "Concentration de Position de Vanne";
$multilang_SPFMODEL_43 = "Ratio de Concentration";
$multilang_SPFMODEL_44 = "PAUSE MANUELLE et CONTROLES des ETAPES";
$multilang_SPFMODEL_45 = "Fonction Manuelle";
$multilang_SPFMODEL_46 = "Machine";
$multilang_SPFMODEL_57 = "Selectionnez votre machine SPF dans le menu deroulant, puis entrez votre heure de debut pour la saisie manuelle DATES-TAMPON. Chaque entree ulterieure sera automatiquement incremente par l'intervalle requis.";
$multilang_SPFMODEL_58 = "Identification de la Machine";
$multilang_SPFMODEL_62 = "pour les Pasteuriseurs";
$multilang_SPFMODEL_63 = "pour les autres Machines";
$multilang_SPFMODEL_65 = "La Machine que vous avez selectionne ne demande pas d'enregistrement certifie. Sinon, un Enregistrement d' Entree manuel a ete mis hors fonction sur cette Machine.";
$multilang_SPFMODEL_67 = "CIP_ETAPE";
$multilang_SPFMODEL_68 = "CIP_TEMP";
$multilang_SPFMODEL_69 = "ETAT";
$multilang_SPFMODEL_77 = "variable manquante- 'SPF NOM'";
$multilang_SPFMODEL_93 = "Pression Differentielle";
$multilang_SPFMODEL_95 = "Selectionnez votre machine (peu importe le type) a partir du menu deroulant, puis entrez une plage de temps de DEBUT et de FIN .Tous les dossiers qui sont disponibles pour la certification seront affiches.";
$multilang_SPFMODEL_109 = "TURBIDITE";
$multilang_SPFMODEL_111 = "manque une variable - 'DISPLAY_UNDER_ALARM_CONDITION_ONLY'";
$multilang_SPFMODEL_112 = "selectionner OUI ou NON pour 'Les donnees enregistrees durant les systemes d'alarmes de communication seulement' ...en selectionnant OUI cela reduit le rapport de sorte que les lectures de turbidite ne soient affichees que si un evenement alarme machine se produit. Ce pourrait etre n'importe quel type d'alarme, ne se limite pas a la turbidite des alarmes (les alarmes sont identifies par leur nom pour homonymie).";
$multilang_SPFMODEL_113 = "La machine que vous avez selectionne ne dispose pas d'un capteur de turbidite installe.Par consequent, ce rapport ne peut etre genere .Si vous croyez que c'est une erreur, contactez votre administrateur systeme, et demander leur de revoir le -.. localoptions fichier - pour ce modele.";
$multilang_SPFMODEL_114 = "ETAPE";
$multilang_SPFMODEL_115 = "TOTAUX POUR LES CAS DE NETTOYAGES";
$multilang_SPFMODEL_117 = "Alarms et Fautes (s'il en existe)";
$multilang_SPFMODEL_118 = "Total utilisation d 'eau";
$multilang_SPFMODEL_120 = "L'utilisation est detraquee par des combinaisons dU SYSTEME-AUTO-NETTOYAGE et INSTANCE DE NETTOYAGE(dans l'ordre) chaque type d'eau est affiche et totalise pour chaque instance Puis chaque type d'eau est totalise pour chaque systeme.";
$multilang_SPFMODEL_121 = "DIMINUTION GLOBALE- Consommation d'eau de l'ensemble par type et machines.";
$multilang_SPFMODEL_122 = "DIMUNITION DETAILS- MACHINE INDIVIDUELLE et TYPE d'EAU Instances, Sequentielle";
$multilang_SPFMODEL_123 = "TOUT_SYSTEMES-AUTO_NETTOYAGES";
$multilang_SPFMODEL_124 = "aucunes des Machines dans ce modele ne sont auto-nettoyantes. Toutes sont nettoyees par d'autres machines ou systemes de nettoyage. Par consequent, un rapport ne sera pas genere a partir de la . Veuillez vous se referer au tableau ci-apres pour plus d'informations...";
$multilang_SPFMODEL_125 = "... est nettoye par ...";
$multilang_SPFMODEL_126 = "LIGNE";
$multilang_SPFMODEL_127 = "TOTAUX pour cette Machine";
$multilang_SPFMODEL_128 = "CONSOMATION GLOBALE -l'ensemble de consommation d'energie par machine";
$multilang_SPFMODEL_129 = "DETAIL CONSOMATION - MACHINE Individuelle et ETAT Instances, Sequentielle";
$multilang_SPFMODEL_130 = "utilisation est decomposee par des combinaisons de la machine et del'Etat (en sequence). Puis la PUISSANCE est totalisee pour chaque systeme...";
$multilang_SPFMODEL_131 = "UTILISATION_PUISSANCE";
$multilang_SPFMODEL_132 = "TOUS_SYSTEMS_ALLIMENTES";
$multilang_SPFMODEL_133 = "Detail Pareto - Individual Machine PUISSANCE Utilisee.";
$multilang_SPFMODEL_134 = "Pareto  - Puissance utilisee [cette Machine]";
$multilang_SPFMODEL_135 = "Global Pareto - Overall PUISSANCE utilise par ETAT";
$multilang_SPFMODEL_136 = "Pourcentage Total Puissance Utilsee [Toutes Machines]";
/*			- to be read as '[machine A] ... is cleaned by ... [machine b]' */
$multilang_SPFMODEL_137 = "TOTAUX pour ce Cycle de Production";
$multilang_SPFMODEL_138 = "ALARMES pour ce Cycle de Production";
$multilang_SPFMODEL_139 = "Felicitations - Pas d'Alarmes Presentes.";
$multilang_SPFMODEL_140 = "DEBIT TOTAL de la Source";
$multilang_SPFMODEL_141 = "Dest_1 DEBIT TOTAL";
$multilang_SPFMODEL_142 = "Dest_2 DEBIT TOTAL";
$multilang_SPFMODEL_143 = "Source DELTA";
$multilang_SPFMODEL_144 = "Dest_1 DELTA";
$multilang_SPFMODEL_145 = "Dest_2 DELTA";
$multilang_SPFMODEL_146 = "Flux de Matieres";
$multilang_SPFMODEL_147 = "Efficacite";
$multilang_SPFMODEL_148 = "Utilite";
/*			-- to be read as '[building] Utility [such as steam or power]' */
$multilang_SPFMODEL_149 = "Pression Differentielle";
$multilang_SPFMODEL_150 = "Resume d'Erreur Mathematique";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_SPFMODEL_17 = $multilang_STATIC_ALARMS;
$multilang_SPFMODEL_47 = $multilang_STATIC_HOLD;
$multilang_SPFMODEL_48 = $multilang_STATIC_STEP;
$multilang_SPFMODEL_49 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_SPFMODEL_50 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_SPFMODEL_51 = $multilang_STATIC_FORCE_HOLD;
$multilang_SPFMODEL_52 = $multilang_STATIC_RELEASE_HOLD;
$multilang_SPFMODEL_53 = $multilang_STATIC_FORCE_STEP;
$multilang_SPFMODEL_54 = $multilang_STATIC_LOCKOUT;
$multilang_SPFMODEL_55 = $multilang_STATIC_RELEASE;
$multilang_SPFMODEL_56 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_SPFMODEL_59 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_SPFMODEL_60 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_SPFMODEL_61 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_SPFMODEL_64 = $multilang_STATIC_DATA_TICKET;
$multilang_SPFMODEL_66 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_SPFMODEL_70 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_SPFMODEL_71 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_SPFMODEL_72 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_SPFMODEL_73 = $multilang_STATIC_CERT_STAMP;
$multilang_SPFMODEL_74 = $multilang_STATIC_CERT_COMMENT;
$multilang_SPFMODEL_75 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_SPFMODEL_76 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_SPFMODEL_78 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_SPFMODEL_79 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_SPFMODEL_80 = $multilang_SPFMODEL_46;
$multilang_SPFMODEL_81 = $multilang_STATIC_SERVER;
$multilang_SPFMODEL_82 = $multilang_STATIC_DB_TABLE;
$multilang_SPFMODEL_83 = $multilang_STATIC_DATE_RANGE;
$multilang_SPFMODEL_84 = $multilang_STATIC_YOUR_USERNAME;
$multilang_SPFMODEL_85 = $multilang_STATIC_CURRENT_TIME;
$multilang_SPFMODEL_86 = $multilang_STATIC_RERUN_REPORT;
$multilang_SPFMODEL_87 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_SPFMODEL_88 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_SPFMODEL_89 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_SPFMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_SPFMODEL_91 = $multilang_STATIC_REVIEW_CERT;
$multilang_SPFMODEL_92 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_SPFMODEL_94 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_SPFMODEL_96 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_SPFMODEL_97 = $multilang_STATIC_FAULTS_CAPS;
$multilang_SPFMODEL_98 = $multilang_STATIC_DATESTAMP_START;
$multilang_SPFMODEL_99 = $multilang_STATIC_DATESTAMP_END;
$multilang_SPFMODEL_100 = $multilang_STATIC_DURATION_CAPS;
$multilang_SPFMODEL_101 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_SPFMODEL_102 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_SPFMODEL_103 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_SPFMODEL_104 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_SPFMODEL_105 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_SPFMODEL_106 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_SPFMODEL_107 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_SPFMODEL_108 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_SPFMODEL_110 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_SPFMODEL_116 = $multilang_STATIC_DURATION;
$multilang_SPFMODEL_119 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
/*			-- do not edit this block unless modifying program */

/*	-- CIPMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CIPMODEL_0 = "CIP MODELE";
$multilang_CIPMODEL_1 = "Moniteur principal";
$multilang_CIPMODEL_2 = "Manuel d'Enregistrement des Entrees";
$multilang_CIPMODEL_3 = "Certificat d'Enregistrement";
$multilang_CIPMODEL_4 = "Utilisation de l'eau";
$multilang_CIPMODEL_5 = "Charte de Temperature";
$multilang_CIPMODEL_6 = "Charte des Performances Optimales";
/*			-- read as 'Full Report' or 'Full System Analysis' */
$multilang_CIPMODEL_7 = "Historique des Alarmes";
$multilang_CIPMODEL_8 = "Activite de Gantt";
$multilang_CIPMODEL_18 = "LIGNE";
$multilang_CIPMODEL_23 = "Selectinnez votre CIP systeme from the drop down, then enter your START TIME for manual entries.  Each subsequent entry's DATESTAMP will automatically be incremented by the required interval.";
$multilang_CIPMODEL_25 = "ETAPE";
$multilang_CIPMODEL_26 = "RETOUR TEMP";
/*			-- to be read as... 'RETURN TEMP[erature]' */
$multilang_CIPMODEL_29 = "Systeme Identification";
$multilang_CIPMODEL_33 = "Selectionnez votre systeme CIP dans le menu deroulant, puis entrez votre heure de depart pour la saisie manuelle Chaque entree ulterieure de DATESTAMP sera automatiquement incremente par l'intervalle requis...";
$multilang_CIPMODEL_36 = "Systeme";
$multilang_CIPMODEL_37 = "TYPE D'EAU";
$multilang_CIPMODEL_38 = "variable manquante - 'CIP NOM'";
$multilang_CIPMODEL_51 = "PAUSE MANUELLE et CONTROLES des ETAPES";
$multilang_CIPMODEL_52 = "Fonction Manuelle";
$multilang_CIPMODEL_59 = "Ligne en Cours de Nettoyage";
$multilang_CIPMODEL_60 = "FOURNITURE TEMP";
/*			-- to be read as... 'SUPPLY TEMP[erature]' */
$multilang_CIPMODEL_61 = "FOURNITURE DEBIT";
$multilang_CIPMODEL_62 = "RETOUR CONDUCTIVITE";
$multilang_CIPMODEL_63 = "STATUS OPERATIONNEL";
$multilang_CIPMODEL_64 = "USAGE DE L'EAU";
$multilang_CIPMODEL_68 = "SYSTEME";
$multilang_CIPMODEL_72 = "OUVRIR L'EAU";
$multilang_CIPMODEL_73 = "FERMER L'EAU";
$multilang_CIPMODEL_74 = "EAU USEE";
$multilang_CIPMODEL_75 = "TOTAUX pour cette Instance de Lavage";
$multilang_CIPMODEL_76 = "TOUT_CIP_SYSTEMES";
$multilang_CIPMODEL_77 = "utilisation est diminuee par la seule combinaison de CIP SYSTEM,TYPE D'EAU, LIGNE ET CIRCUIT. Alors chaque TYPE D'EAU est totalisee pour chaque SYSTEME.";
$multilang_CIPMODEL_78 = "Global Rundown - Ensemble Consomation Eau par System et Type";
$multilang_CIPMODEL_79 = "Detail Rundown - Individual SYSTEM, LIGNE, and TYPE D'EAU Instances";
$multilang_CIPMODEL_87 = "Alarmes et Defauts (si aucun)";
$multilang_CIPMODEL_88 = "Consomation d'Eau";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_CIPMODEL_9 = $multilang_CIPMODEL_2;
$multilang_CIPMODEL_10 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_CIPMODEL_11 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_CIPMODEL_12 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_CIPMODEL_13 = $multilang_STATIC_CERT_STAMP;
$multilang_CIPMODEL_14 = $multilang_STATIC_CERT_COMMENT;
$multilang_CIPMODEL_15 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_CIPMODEL_16 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_CIPMODEL_17 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_CIPMODEL_19 = $multilang_STATIC_DATA_TICKET;
$multilang_CIPMODEL_20 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_CIPMODEL_21 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_CIPMODEL_22 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_CIPMODEL_24 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_CIPMODEL_27 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_CIPMODEL_28 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_CIPMODEL_30 = $multilang_STATIC_REVIEW_CERT;
$multilang_CIPMODEL_31 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_CIPMODEL_32 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_CIPMODEL_34 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_CIPMODEL_35 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_CIPMODEL_39 = $multilang_STATIC_RERUN_REPORT;
$multilang_CIPMODEL_40 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_CIPMODEL_41 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_CIPMODEL_42 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_CIPMODEL_43 = $multilang_CIPMODEL_36;
$multilang_CIPMODEL_44 = $multilang_STATIC_SERVER;
$multilang_CIPMODEL_45 = $multilang_STATIC_DB_TABLE;
$multilang_CIPMODEL_46 = $multilang_STATIC_DATE_RANGE;
$multilang_CIPMODEL_47 = $multilang_STATIC_YOUR_USERNAME;
$multilang_CIPMODEL_48 = $multilang_STATIC_CURRENT_TIME;
$multilang_CIPMODEL_49 = $multilang_CIPMODEL_3;
$multilang_CIPMODEL_50 = $multilang_CIPMODEL_1;
$multilang_CIPMODEL_53 = $multilang_STATIC_HOLD;
$multilang_CIPMODEL_54 = $multilang_STATIC_STEP;
$multilang_CIPMODEL_55 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_CIPMODEL_56 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_CIPMODEL_57 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_CIPMODEL_58 = $multilang_STATIC_FAULTS_CAPS;
$multilang_CIPMODEL_65 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_CIPMODEL_66 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_CIPMODEL_67 = $multilang_CIPMODEL_4;
$multilang_CIPMODEL_69 = $multilang_STATIC_DATESTAMP_START;
$multilang_CIPMODEL_70 = $multilang_STATIC_DATESTAMP_END;
$multilang_CIPMODEL_71 = $multilang_STATIC_DURATION_CAPS;
$multilang_CIPMODEL_80 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_CIPMODEL_81 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_CIPMODEL_82 = $multilang_STATIC_CERT_NO_COMMENTS;
$multilang_CIPMODEL_83 = $multilang_STATIC_CERT_SIGNATURE_HEADER;
$multilang_CIPMODEL_84 = $multilang_STATIC_CERT_NO_SIGS;
$multilang_CIPMODEL_85 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
$multilang_CIPMODEL_86 = $multilang_STATIC_DURATION;
$multilang_CIPMODEL_89 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_CIPMODEL_90 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_CIPMODEL_91 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_CIPMODEL_92 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_CIPMODEL_93 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_CIPMODEL_94 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_CIPMODEL_95 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_CIPMODEL_96 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_CIPMODEL_100 = $multilang_STATIC_FORCE_HOLD;
$multilang_CIPMODEL_102 = $multilang_STATIC_RELEASE_HOLD;
$multilang_CIPMODEL_103 = $multilang_STATIC_FORCE_STEP;
$multilang_CIPMODEL_104 = $multilang_STATIC_LOCKOUT;
$multilang_CIPMODEL_105 = $multilang_STATIC_RELEASE;

/*	-- BULKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_BULKMODEL_0 = "BULK MODEL";
$multilang_BULKMODEL_1 = "Moniteur Principal";
$multilang_BULKMODEL_2 = "Inventaire des Stocks";
$multilang_BULKMODEL_3 = "Diminution des Articles en Magasin";
$multilang_BULKMODEL_4 = "Resume de l'Inventaire";
$multilang_BULKMODEL_9 = "Volume";
/*			-- to be read as... 'Volume [measure of quantity, typically liquid or mass]' */
$multilang_BULKMODEL_10 = "Poucentage de la Capacite de Reserve";
/*			-- to be read as... 'Percent Stock [of Capacity]' */
$multilang_BULKMODEL_12 = "Capture instantanee de l'Historique de l' inventaire";
$multilang_BULKMODEL_14 = "POURCENTAGE DE LA CAPACITE DE RESERVE";
$multilang_BULKMODEL_15 = "QUANTITE INVENTORIEE";
$multilang_BULKMODEL_23 = "Heure de la Capture Automatique";
$multilang_BULKMODEL_25 = "Inventaire";
$multilang_BULKMODEL_29 = "variable manquante - 'BULK NOM'";
$multilang_BULKMODEL_30 = "Historique par Article";
$multilang_BULKMODEL_31 = "Utilisation d'Article";
$multilang_BULKMODEL_33 = "Quantite Utilisee";
$multilang_BULKMODEL_34 = "ce rapport d'utilisation d'article utilise la 'logique floue' pour tenir compte de la reconstitution des stocks (qui n'est pas enregistree) et communement utilise des capteurs de materiaux en vrac (avec en general un ecart de precision de 2 a 5 pour cent). En consequence, ce rapport devrait etre precis a 5 pour cent pres, mais peut varier. Il est destine a etre utilise comme une 'estimation', donc ne convient pas pour la facturation ou les ventes commerciales. Si vous suspectez un ecart deraisonnable, alors utilisez RAPPORT-1 (Diminution des ARTICLES) pour afficher l'effective lectures du capteur au cours de la periode demandee.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_BULKMODEL_5 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_BULKMODEL_6 = $multilang_STATIC_CURRENT_TIME;
$multilang_BULKMODEL_7 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_BULKMODEL_8 = $multilang_STATIC_ITEM_LOWER;
$multilang_BULKMODEL_11 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_BULKMODEL_16 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_BULKMODEL_17 = $multilang_STATIC_REPORT_TICKET_FOR;
$multilang_BULKMODEL_13 = $multilang_STATIC_ITEM;
$multilang_BULKMODEL_18 = $multilang_STATIC_DATA_WITHIN_15;
$multilang_BULKMODEL_19 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_BULKMODEL_20 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_BULKMODEL_21 = $multilang_STATIC_CURRENT_BLIP;
$multilang_BULKMODEL_22 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_BULKMODEL_24 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_BULKMODEL_26 = $multilang_STATIC_DATESTAMP;
$multilang_BULKMODEL_27 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_BULKMODEL_28 = $multilang_STATIC_RERUN_REPORT;
$multilang_BULKMODEL_32 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

/*	-- ATMOSPHERICMODEL */
/* 	------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_ATMOSPHERICMODEL_0 = "ATMOSPHERIC MODELE";
$multilang_ATMOSPHERICMODEL_1 = "Moniteur Principal";
$multilang_ATMOSPHERICMODEL_2 = "environnement graphique et analytique";
$multilang_ATMOSPHERICMODEL_3 = "missing variable manquante - 'NOM DE ZONE'";
$multilang_ATMOSPHERICMODEL_4 = "Zone";
$multilang_ATMOSPHERICMODEL_5 = "Temperature";
$multilang_ATMOSPHERICMODEL_6 = "Humidite";
$multilang_ATMOSPHERICMODEL_7 = "Pression";
$multilang_ATMOSPHERICMODEL_8 = "TEMPERATURE MOYENNE";
$multilang_ATMOSPHERICMODEL_9 = "HUMIDITE MOYENNE";
$multilang_ATMOSPHERICMODEL_10 = "PRESSION MOYENNE";
$multilang_ATMOSPHERICMODEL_11 = "ENREGISTREMENT EXAMINE";
$multilang_ATMOSPHERICMODEL_12 = "TEMPERATURE ACTUELLE";
$multilang_ATMOSPHERICMODEL_13 = "HUMIDITY ACTUELLE";
$multilang_ATMOSPHERICMODEL_14 = "PRESSURE ACTUELLE";
$multilang_ATMOSPHERICMODEL_16 = "minute.";
/*		-- to be read as "[abbreviation for] minutes" */

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_ATMOSPHERICMODEL_15 = $multilang_STATIC_EXAMINATION_WINDOW;
/*			-- do not edit this block unless modifying program */

/*	-- CHECKWEIGHERMODEL */
/* 	-------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CHECKWEIGHERMODEL_0 = "BALANCE MODELE";
$multilang_CHECKWEIGHERMODEL_1 = "modifier RECETTE";
$multilang_CHECKWEIGHERMODEL_2 = "RECETTE A MODIFIER";
$multilang_CHECKWEIGHERMODEL_3 = "effacer RECETTE";
$multilang_CHECKWEIGHERMODEL_4 = "RECETTE A EFFACER";
$multilang_CHECKWEIGHERMODEL_5 = "ajouter RECETTE et parametres";
$multilang_CHECKWEIGHERMODEL_6 = "RECETTE";
$multilang_CHECKWEIGHERMODEL_7 = "Tous les champs variables RECETTE doivent etre remplis avant qu'une recette puisse etre ajoutee. Veuillez examiner le formulaire, remplissez-le et renvoyez-le...";
$multilang_CHECKWEIGHERMODEL_8 = "RESERVE AUX ADMINISTRATEURS ET SUPER UTIISATEURS.";
$multilang_CHECKWEIGHERMODEL_9 = "PARAMETRES: ajouter RECETTE";
$multilang_CHECKWEIGHERMODEL_10 = "NOM DE LA RECETTE";
$multilang_CHECKWEIGHERMODEL_11 = "un seul nom par recette";
$multilang_CHECKWEIGHERMODEL_12 = "OBJECTIF";
$multilang_CHECKWEIGHERMODEL_13 = "masse desiree";
$multilang_CHECKWEIGHERMODEL_14 = "DELTA MIN";
$multilang_CHECKWEIGHERMODEL_15 = "rejeter pour ce montant INFERIEUR A L'OBJECTIF";
$multilang_CHECKWEIGHERMODEL_16 = "DELTA MAX";
$multilang_CHECKWEIGHERMODEL_17 = "rejeter pour ce montant SUPERIEUR A L'OBJECTIF";
$multilang_CHECKWEIGHERMODEL_18 = "Engager addition RECETTE";
$multilang_CHECKWEIGHERMODEL_19 = "Cette recette a ete ajoute avec succes a la base de donnees.";
$multilang_CHECKWEIGHERMODEL_20 = "Si vous souhaitez ajouter une autre recette,cliquez ici...";
$multilang_CHECKWEIGHERMODEL_21 = "effacer RECETTE";
$multilang_CHECKWEIGHERMODEL_22 = "La recette a ete supprime, comme vous l'avez demande. Vous devriez etre automatiquement redirige vers la page S.E.E.R parametres... sinon, y naviguer en utilisant le menu, en haut de la page";
$multilang_CHECKWEIGHERMODEL_23 = "Parametre: modifier RECETTE";
$multilang_CHECKWEIGHERMODEL_24 = "Engager modification RECETTE";
$multilang_CHECKWEIGHERMODEL_25 = "CREER DATE";
$multilang_CHECKWEIGHERMODEL_26 = "CREER PAR";
$multilang_CHECKWEIGHERMODEL_27 = "DATE MISE A JOUR";
$multilang_CHECKWEIGHERMODEL_28 = "MISE A JOUR PAR";
$multilang_CHECKWEIGHERMODEL_29 = "PEUPLER SYPHON TABLE";
$multilang_CHECKWEIGHERMODEL_30 = "REMPLIR SYPHON table";
$multilang_CHECKWEIGHERMODEL_31 = "La sortie devrait inclure une entree pour chaque machine, comme indique dans chacun de vos fichiers localoptions.";
$multilang_CHECKWEIGHERMODEL_32 = "Moniteur Departement";
$multilang_CHECKWEIGHERMODEL_33 = "Runtime Analyses et synthese";
$multilang_CHECKWEIGHERMODEL_34 = "TARE";
$multilang_CHECKWEIGHERMODEL_35 = "non-produit masse";
$multilang_CHECKWEIGHERMODEL_36 = "controle Recette";
$multilang_CHECKWEIGHERMODEL_37 = "La trieuse ponderale que vous recherchez n'existe pas dans la base de donnees machine siphon. Verifiez aupres de votre administrateur systeme, et soyez sur qu'il ou elle ont execute la commande 'Rempli SYPHON Table 'dans l'onglet 'Parametres' dans SEER.";
$multilang_CHECKWEIGHERMODEL_38 = "La trieuse ponderale est programmee hors service ou n'est pas utilises a l'heure actuelle.";
$multilang_CHECKWEIGHERMODEL_39 = "La trieuse ponderale est en service, mais aucun element de poids n'a ete enregistre pendant la periode de capture instantanee (histoire recente). Typiquement, cela indique que la ligne de production est en baisse pour une raison quelconque. Cependant, s'il est en marche, cela indique que la communication de la trieuse ponderale avec siphon est en panne et doit etre corrigee (contacter un administrateur systeme).";
$multilang_CHECKWEIGHERMODEL_40 = "N'EXISTE PAS!";
$multilang_CHECKWEIGHERMODEL_41 = "Veille / Hors-Service";
$multilang_CHECKWEIGHERMODEL_42 = "Veille / En Service mais aucune Activite";
$multilang_CHECKWEIGHERMODEL_43 = "FENETRE Historique Temp recent";
$multilang_CHECKWEIGHERMODEL_44 = "Minimum";
$multilang_CHECKWEIGHERMODEL_45 = "Maximum";
$multilang_CHECKWEIGHERMODEL_46 = "Quantite";
$multilang_CHECKWEIGHERMODEL_47 = "Masse Totale";
$multilang_CHECKWEIGHERMODEL_48 = "Masse moyenne";
$multilang_CHECKWEIGHERMODEL_49 = "BAREME TAUX";
$multilang_CHECKWEIGHERMODEL_50 = "min.";
/*			-- to be read as abbreviation for 'minute' */
$multilang_CHECKWEIGHERMODEL_51 = "Accepte";
$multilang_CHECKWEIGHERMODEL_52 = "Rejete";
$multilang_CHECKWEIGHERMODEL_53 = "La trieuse ponderale est programme hors service ou n'est pas utilise a l'heure actuelle - cependant la trieuse ponderale communique des donnees au systeme d'enregistrement. Cela se produit generalement lorsque la ligne est effectivement en cours d'execution, mais l'exploitant a omis d'inscrire la Recette actuelle de la trieuse ponderale dans SEER. Vous etes invites a inspecter la trieuse ponderale en personne et de determiner si tel est le cas.";
$multilang_CHECKWEIGHERMODEL_54 = "recette pour pousser la trieuse ponderale / RECETTE DE FONCTIONNEMENT Mise a jour.";
$multilang_CHECKWEIGHERMODEL_55 = "Les 10 derniers echantillons";
$multilang_CHECKWEIGHERMODEL_56 = "Poids individuel a la sortie";
$multilang_CHECKWEIGHERMODEL_57 = "Echelle pour Examiner";
$multilang_CHECKWEIGHERMODEL_58 = "trieuse ponderale";
$multilang_CHECKWEIGHERMODEL_59 = "echelle pour EXAMINER n'a pas ete selectionne, vous devez selectionner la trieuse ponderale que vous voulez examiner, avant vous pouvez generer un rapport.S'il vous plait revenir au menu precedent, et remplissez le formulaire completement.";
$multilang_CHECKWEIGHERMODEL_60 = "MASSE BRUTE";
$multilang_CHECKWEIGHERMODEL_61 = "MASSE NETTE";
$multilang_CHECKWEIGHERMODEL_62 = "RESULTAT";
$multilang_CHECKWEIGHERMODEL_63 = "TRIEUSE PONDERALE";
$multilang_CHECKWEIGHERMODEL_64 = "vous pouvez choisir d'afficher uniquement un echantillon des enregistrements renvoyes (grande ou petite), repartis uniformement dans le temps, ou, vous pouvez choisir d'afficher chaque fiche. Soyez avise, la visualisation de chaque enregistrement est un rapport volumineux, et si vous selectionnez plus d'une heure ou deux (sur le nombre de produits par minute votre balance peut s'executer), vous pouvez verrouiller votre navigateur. La methode recommandee consiste a afficher un 'echantillonnage', puis revenir en arriere et visialiser 'tous les enregistrements' pour ceux des periodes de temps qui ont montre un interet dans 'l'echantillonnage'.";
$multilang_CHECKWEIGHERMODEL_65 = "Rapport Methode";
$multilang_CHECKWEIGHERMODEL_66 = "Petit Echantillon Periodique ";
$multilang_CHECKWEIGHERMODEL_67 = "Examine Chaque Enregistrement";
$multilang_CHECKWEIGHERMODEL_68 = "RAPPORT methode n'a pas ete selectionne.Vous devez choisir la methode de declaration que vous voulez utiliser avant de vous pouvoir rediger un rapport.Veuillez revenir au menu precedent, et remplissez le formulaire completement.";
$multilang_CHECKWEIGHERMODEL_69 = "Exemple de longue periode.";
$multilang_CHECKWEIGHERMODEL_70 = "TAUX";
$multilang_CHECKWEIGHERMODEL_71 = "Standard Deviation";
$multilang_CHECKWEIGHERMODEL_72 = "PLAN DE DISTRIBUTION NORMALE";
$multilang_CHECKWEIGHERMODEL_73 = "REFUS UNITE ENREGISTRES DURANT INSTANCE DE CETTE RECETTE";
$multilang_CHECKWEIGHERMODEL_74 = "A OFFRIR OU A EMPORTER";
$multilang_CHECKWEIGHERMODEL_75 = "OFFERT";
$multilang_CHECKWEIGHERMODEL_76 = "EMPORTER";
$multilang_CHECKWEIGHERMODEL_77 = "Prevision Production Acceptee";
$multilang_CHECKWEIGHERMODEL_78 = "Accort Actuel Production";
$multilang_CHECKWEIGHERMODEL_79 = "Difference";
$multilang_CHECKWEIGHERMODEL_80 = "Voir les Articles Refuses";
$multilang_CHECKWEIGHERMODEL_81 = "OPERATEUR";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
/*	-- none as of yet */
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR */
/*	---------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_0 = "WARRIOR";
$multilang_WARRIOR_1 = "Ajouter une tache et une description";
$multilang_WARRIOR_2 = "modifier emploi";
$multilang_WARRIOR_3 = "Parametres: ajouter une tache";
$multilang_WARRIOR_4 = "NUMERO DE TACHE";
$multilang_WARRIOR_5 = "un certain nombre de ressources";
$multilang_WARRIOR_6 = "EMPLOI DESCRIPTION";
$multilang_WARRIOR_7 = "une description de la tache";
$multilang_WARRIOR_8 = "Engager une Addition de tache";
$multilang_WARRIOR_9 = "Le Numero de tache souhaite existe deja Si vous souhaitez ajouter un nouvel enregistrement, vous devez d'abord supprimer la tache actuelle.";
$multilang_WARRIOR_10 = "Tous les champs variables de tache doivent etre remplis avant qu'un travail puissent etre ajoute S'il vous plait examiner le formulaire, remplissez-le et renvoyez-le.";
$multilang_WARRIOR_11 = "RESERVE AUX ADMINISTRATEURS, SUPER UTILISATEURS ET MANAGERS.";
$multilang_WARRIOR_12 = "Cette tache a ete ajoute avec succes a la base de donnees.";
$multilang_WARRIOR_13 = "Si vous souhaitez ajouter une autre tache, cliquez ici ...";
$multilang_WARRIOR_14 = "Parametres: modifier TACHE";
$multilang_WARRIOR_15 = "ENGAGER Modification TACHE";
$multilang_WARRIOR_16 = "supprimer la TACHE";
$multilang_WARRIOR_17 = "Le travail a ete supprimee, comme vous avez demande. Vous devriez etre automatiquement redirige vers la page SEER reglage.";
$multilang_WARRIOR_18 = "TACHE A MODIFIER";
$multilang_WARRIOR_19 = "NUMERO DE TACHE A SUPPRIMER";
$multilang_WARRIOR_20 = "O.E.E.";
$multilang_WARRIOR_21 = "Moniteur principal & Controle";
$multilang_WARRIOR_22 = "SELECTIONNER MACHINE";
$multilang_WARRIOR_23 = "Lancer la Console";
$multilang_WARRIOR_24 = "Identification de la Machine";
$multilang_WARRIOR_25 = "Selectionnez votre appareil a partir du menu deroulant, et le lancement de la Console Live.";
$multilang_WARRIOR_26 = "Operations";
$multilang_WARRIOR_27 = "SELECTIONNER";
$multilang_WARRIOR_28 = "ACTION CORRECTIVE";
$multilang_WARRIOR_29 = "Mise a Jour";
$multilang_WARRIOR_30 = "OPERATEUR ou ARTISAN";
$multilang_WARRIOR_31 = "Abandon Machine";
$multilang_WARRIOR_32 = "Prendre le Controle de la Machine";
$multilang_WARRIOR_33 = "MODE MAINTENANCE";
$multilang_WARRIOR_34 = "Enter en Mode Maintenance";
$multilang_WARRIOR_35 = "Communique de Production";
$multilang_WARRIOR_36 = "NOMBRE PROGRAME";
$multilang_WARRIOR_37 = "L'exploitant doit prendre le controle d'une machine avant qu'ils puissent modifier la CORRECTIVE_ACTION PROGRAMME_NOMBRE, TACHE_NOMBRE, ou meme, gens de metier qualifies doivent assumer le controle d'une machine avant de pouvoir la mettre en MAINTENANCE_MODE (ou RELEASE_TO_PRODUCTION).";
$multilang_WARRIOR_38 = "STATUT de la MACHINE";
$multilang_WARRIOR_39 = "Le statut ne peut etre determinee en ce moment en raison du manque de donnees suffisantes Si vous croyez que cela soit une erreur, s'il vous plait contactez un administrateur systeme de l'aide."; 
$multilang_WARRIOR_40 = "DONNEES RAFRAICHIES COMME";
$multilang_WARRIOR_41 = "OPERATEUR ACTUEL";
$multilang_WARRIOR_44 = "STATUS MACHINE";
$multilang_WARRIOR_45 = "STATUT ALARME";
$multilang_WARRIOR_47 = "CLASSE D'EMBALLAGE";
$multilang_WARRIOR_48 = "EMBALLAGE PAR CYCLE";
$multilang_WARRIOR_49 = "CYCLES [ce travail & horaire]";
$multilang_WARRIOR_50 = "UNITES";
$multilang_WARRIOR_51 = "MASSE";
$multilang_WARRIOR_52 = "Sommaire de Production Recente";
$multilang_WARRIOR_53 = "min.";
/*			-- to be read as [abbreviation for] 'minutes' */
$multilang_WARRIOR_54 = "Heure de TRAVAIL";
$multilang_WARRIOR_55 = "Tour de Garde";
$multilang_WARRIOR_56 = "UNITES Recentes";
$multilang_WARRIOR_57 = "NON PREVUE";
$multilang_WARRIOR_58 = "Tenps MORT";
$multilang_WARRIOR_59 = "heure";
$multilang_WARRIOR_60 = "PERFORMANCE";
$multilang_WARRIOR_61 = "DISPONIBILITE";
$multilang_WARRIOR_62 = "O.E.E.";
$multilang_WARRIOR_63 = "T.E.E.P.";
$multilang_WARRIOR_64 = "CHARGEMENT";
$multilang_WARRIOR_65 = "TOUR";
$multilang_WARRIOR_66 = "BAS";
$multilang_WARRIOR_68 = "Chef de Departement";
$multilang_WARRIOR_69 = "Ligne";
/*			-- to be read as... [production]'line' */
$multilang_WARRIOR_70 = "TAUX EFFECTIF DE LA LIGNE";
$multilang_WARRIOR_71 = "OBJECTIF DE LA LIGNE";
$multilang_WARRIOR_72 = "TOTAUX, DES TRAVAUX PROGRAME";
$multilang_WARRIOR_73 = "Debit Brut";
$multilang_WARRIOR_74 = "Entrez votre date de debut et de fin. Vous pouvez choisir d'afficher les donnees pour les POSTES de travail de tous, un planning de travail particulier, ou selectionnez une heure PERSONNALISER (Travail). Si vous choisissez d'utiliser un deplacement personnalise, vous devez selectionner PERSONNALISER HEURE DE DEBUT et PERSONNALISER HEURE FIN, sinon vous pouvez laisser ces champs vides.";
$multilang_WARRIOR_75 = "HORAIRES DE TRAVAIL";
$multilang_WARRIOR_76 = "PERSONNALISER";
$multilang_WARRIOR_77 = "TOUT";
$multilang_WARRIOR_78 = "Personnaliser DEBUT Heure";
$multilang_WARRIOR_79 = "Personnaliser FIN Heure";
$multilang_WARRIOR_80 = "Lors de la selection des horaires de travail de 'PERSONNALISER', vous devez specifier d'un DEBUT et de FIN des heures comme un intervalle de temps a examiner.Une d'elles est vide.";
$multilang_WARRIOR_81 = "Machine";
$multilang_WARRIOR_82 = "TOTAL d'Unites";
$multilang_WARRIOR_83 = "Masse TOTALE";
$multilang_WARRIOR_84 = "TOTAUX SYNERGIQUE";
$multilang_WARRIOR_85 = "overall department production d'ensemble du departement";
$multilang_WARRIOR_86 = "TOTAUX DISCRET";
$multilang_WARRIOR_87 = "Instances des TACHES PROGRAME par machine individuelle";
$multilang_WARRIOR_88 = "Fin de COURSE";
$multilang_WARRIOR_89 = "Le debut et les heures de fin ne peuvent pas etre les memes, ce qui se traduit par une duree de travail de zero heure."; 
$multilang_WARRIOR_90 = "ce calculateur a ete teste avec une precision de 0,15%, les resultats sont promis avec une precision de 0,25%, ce petit ecart est due au temps 'arrondissement' vers le haut ou vers le bas aux points de rotation,changement de quart.";
$multilang_WARRIOR_91 = "Maintenance Mode Historique";
$multilang_WARRIOR_92 = "Maintenance DEBUT";
$multilang_WARRIOR_93 = "Maintenance FIN";
$multilang_WARRIOR_94 = "Duree";
$multilang_WARRIOR_95 = "Type de Maintenance";
$multilang_WARRIOR_96 = "les instances par machine individuelle en mode MAINTENANCE";
$multilang_WARRIOR_97 = "les statistiques globales du departmenten mode MAINTENANCE";
$multilang_WARRIOR_98 = "TOTAL du Temps Repartit";
$multilang_WARRIOR_99 = "TOTAL du Temps Prevu";
$multilang_WARRIOR_100 = "TOTAL du Temps de Maintenance";
$multilang_WARRIOR_101 = "hrs.";
/*			-- to be read as [abbreviation for] 'hours' */
$multilang_WARRIOR_102 = "O.E.E., T.E.E.P., & Temps Mort Analyses";
$multilang_WARRIOR_103 = "ensemble de performence du department";
$multilang_WARRIOR_104 = "Periode de Temps";
/*			-- to be read as 'length of time' or 'time period' */
$multilang_WARRIOR_105 = "Alarme individuelle et instances de temps mort";
$multilang_WARRIOR_108 = "detail Faible - RESUME SEULEUMENT";
$multilang_WARRIOR_109 = "detail Moyen- Rapport d'incident pour les evenements d'une duree de 10 minutes";
$multilang_WARRIOR_110 = "detail Haut - Rapport d'incident pour les evenements d'une duree de 5 minutes";
$multilang_WARRIOR_111 = "detail Extreme - Rapport d'incident pour TOUS les evenements (independamment de la duree)";
$multilang_WARRIOR_112 = "NIVEAU DE DETAIL";
$multilang_WARRIOR_113 = "Type d'ALARME";
$multilang_WARRIOR_114 = "abandon de la machine comme prevu";
$multilang_WARRIOR_115 = "abandon de machine pour pause dejeuner ou autre pause";
$multilang_WARRIOR_116 = "abandon de machine pour cause de fautes ou de panne";
$multilang_WARRIOR_117 = "machine PARETO des circonstances TEMPS-MORTS";
$multilang_WARRIOR_118 = "RANG";
$multilang_WARRIOR_119 = "machine INDIVIDUELLE PARETO DE circonstances NON PROGRAMEES";
$multilang_WARRIOR_120 = "ANALYSIS HYBRIDES";
$multilang_WARRIOR_121 = "ANALYSES DISCRETES";
$multilang_WARRIOR_122 = "machine individuelle PARETO des circonstances NON PLANNIFIEES PROGRAMEES";
$multilang_WARRIOR_123 = "machine PARETO des circonstances TEMPS-MORTS";
$multilang_WARRIOR_124 = "Class ALARMES";
$multilang_WARRIOR_125 = "Le nom, 'WARRIOR', droit d'auteur Ultimate Creations, Inc de 1997 a 2010";
$multilang_WARRIOR_126 = "L'appellation eponyme de la S.E.E.R taux de rendement global / total de l'equipement efficace / module de rendement efficace est une combinaison de plusieurs choses - un acronyme ([W] Workplace [A] Authenticated [R] Resource [R] Runtime [I] Input and [O] Output [R] Reporter), un commentaire sur les circonstances entourant la creation du module et ce qu'elle represente pour l'auteur, ainsi qu'un hommage a l'homme (du meme nom) qui apporte l'accent et l'inspiration pour beaucoup."; 
$multilang_WARRIOR_127 = "Etat du tri pour chaque indication marque en 'Vert' pour reussi ou 'Rouge' pour echoue... Un tri reussi est necessaire pour une identification exacte d'evenement et temps.";
$multilang_WARRIOR_128 = "popu SCHEDULE table";
$multilang_WARRIOR_129 = "Peupler table programation";
$multilang_WARRIOR_130 = "La sortie devrait inclure une entree pour chaque machine, comme indique dans chacun de vos fichiers options locales.";
$multilang_WARRIOR_131 = "pourcentage de TEMPS d'INDISPONIBILITE";
$multilang_WARRIOR_132 = "pourcentage du TEMPS TOTAL";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_42 = $multilang_WARRIOR_36;
$multilang_WARRIOR_43 = $multilang_WARRIOR_4;
$multilang_WARRIOR_46 = $multilang_WARRIOR_28;
$multilang_WARRIOR_67 = $multilang_WARRIOR_57;
$multilang_WARRIOR_106 = $multilang_STATIC_START;
$multilang_WARRIOR_107 = $multilang_STATIC_END;
$multilang_WARRIOR_133 = $multilang_CHECKWEIGHERMODEL_12;
$multilang_WARRIOR_134 = $multilang_WARRIOR_60;
$multilang_WARRIOR_135 = $multilang_CHECKWEIGHERMODEL_81;
$multilang_WARRIOR_136 = $multilang_CIPMODEL_18;
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR FOR LABEL PLUGINS */
/*	---------------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_LABEL_1 = "IMPRESSION";
$multilang_WARRIOR_LABEL_2 = "ARRETEE";
$multilang_WARRIOR_LABEL_3 = "DEMANDER DES ETIQUETTES NOUVEAU";
$multilang_WARRIOR_LABEL_4 = "ANNULER LES ETIQUETTES";
$multilang_WARRIOR_LABEL_5 = "LOT";
$multilang_WARRIOR_LABEL_6 = "Situation Actuelle";
$multilang_WARRIOR_LABEL_12 = "CODE de DATE";
$multilang_WARRIOR_LABEL_13 = "Fin de Palettisation de L'etat de Courir";
$multilang_WARRIOR_LABEL_14 = "FIN de la COURSE";
$multilang_WARRIOR_LABEL_15 = "FIN de L'ATTENTE de la COURSE";
$multilang_WARRIOR_LABEL_16 = "invalides nombre calendrier";
$multilang_WARRIOR_LABEL_17 = "Erreurs ou des Messages";
$multilang_WARRIOR_LABEL_18 = "etiquettes annulees";
$multilang_WARRIOR_LABEL_19 = "demande d'etiquette reussie";
$multilang_WARRIOR_LABEL_20 = "des donnees non valides entree de l'utilisateur";
$multilang_WARRIOR_LABEL_21 = "MODIFIER LES ETIQUETTES";
$multilang_WARRIOR_LABEL_22 = "etiquette de mise a jour reussie";
$multilang_WARRIOR_LABEL_23 = "echoue a changer le numero de lot";
$multilang_WARRIOR_LABEL_24 = "DATE DE PRODUCTION";
$multilang_WARRIOR_LABEL_25 = "impossible de demarrer le systeme d'dtiquetage";
$multilang_WARRIOR_LABEL_26 = "FORCER ANNULER";
$multilang_WARRIOR_LABEL_27 = "pas reussi a annuler l'action du systeme d'etiquetage";
$multilang_WARRIOR_LABEL_28 = "l'etat actuel du systeme d'etiquetage ne ​​peut pas etre determinee, aucune retroaction";
$multilang_WARRIOR_LABEL_29 = "numero d'erreur genere par le systeme d'etiquetage";
$multilang_WARRIOR_LABEL_30 = "impossible de communiquer correctement avec le serveur du systeme d'etiquetage";
$multilang_WARRIOR_LABEL_31 = "FORCER TOUS ANNULER";
$multilang_WARRIOR_LABEL_32 = "action pendante dans le progres!";
$multilang_WARRIOR_LABEL_33 = "Actions Plugin APlus etes connecte. Cela comprend les deux boutons de commande d'utilisateur et les actions du plugin systeme resultant. En raison de la serialisation des actions, il n'est pas utile d'afficher les defauts seulement. Plutot, vous devez selectionner une plage de temps pour voir, et toutes les actions seront affiches sur cette plage de temps.";
$multilang_WARRIOR_LABEL_34 = "Recherche Histoire d'action";
$multilang_WARRIOR_LABEL_35 = "variable manquante - 'LINE'";
$multilang_WARRIOR_LABEL_36 = "repli";
$multilang_WARRIOR_LABEL_37 = "systeme d'etiquetage ne ​​repond pas a la demande pour confirmer l'etat du systeme, contacter l'administrateur";
$multilang_WARRIOR_LABEL_38 = "systeme d'etiquetage signale un changement inattendu statut d'execution, l'etiquetage a ete re-synchronise";
$multilang_WARRIOR_LABEL_39 = "Contre Destination Package";
$multilang_WARRIOR_LABEL_40 = "POIDS PALETTE a la MAIN STACK";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_LABEL_7 = $multilang_TANKMODEL_95;
$multilang_WARRIOR_LABEL_8 = $multilang_WARRIOR_36;
$multilang_WARRIOR_LABEL_9 = $multilang_WARRIOR_4;
$multilang_WARRIOR_LABEL_10 = $multilang_WARRIOR_LABEL_5;
$multilang_WARRIOR_LABEL_11 = $multilang_CHECKWEIGHERMODEL_81;
/*			-- do not edit this block unless modifying program */

/*	-- THIN CHART */
/* 	------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_THINCHART_0 = "TABLEAU MINCE";
$multilang_THINCHART_4 = "Tracees Tableau";
$multilang_THINCHART_5 = "variable manquante - 'nom du graphique'";
$multilang_THINCHART_8 = "Nom du EVENEMENT";
$multilang_THINCHART_9 = "EVENEMENT";
$multilang_THINCHART_10 = "Selectionnez votre Systeme dans le menu deroulant, puis entrez votre heure de depart pour la saisie manuelle Chaque entree ulterieure de DATESTAMP sera automatiquement incremente par l'intervalle requis...";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_THINCHART_1 = $multilang_TANKMODEL_1;
$multilang_THINCHART_2 = $multilang_TANKMODEL_3;
$multilang_THINCHART_3 = $multilang_TANKMODEL_4;
$multilang_THINCHART_6 = $multilang_CIPMODEL_68;
$multilang_THINCHART_7 = $multilang_CIPMODEL_36;
$multilang_THINCHART_11 = $multilang_TANKMODEL_128;
$multilang_THINCHART_12 = $multilang_TANKMODEL_129;
$multilang_THINCHART_13 = $multilang_WARRIOR_77;
/*			-- do not edit this block unless modifying program */

/*	-- CANVAS */
/* 	--------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CANVAS_0 = "TOILE PopUP";
$multilang_CANVAS_1 = "ERREUR - contenu de cette toile n'a pas ete sa proclamation.";
$multilang_CANVAS_2 = "Fermer cette fenetre ou un onglet pour revenir a votre session.";
$multilang_CANVAS_3 = "ERREUR - titre qui n'est pas declaree";
$multilang_CANVAS_4 = "l'Echelle PopUP pour l'Affichage de Precision";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */

/*			-- do not edit this block unless modifying program */

/*	-- TTY PERFORMANCE MODEL */
/* 	------------------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TTYPERFORMANCEMODEL_0 = "TTY MODELE DE PERFORMANCE";
$multilang_TTYPERFORMANCEMODEL_2 = "Sortie Entree Individuelle";
$multilang_TTYPERFORMANCEMODEL_16 = "performances de l'appareil individuel";
$multilang_TTYPERFORMANCEMODEL_18 = "TOUS LES DISPOSITIFS INCLUS";
$multilang_TTYPERFORMANCEMODEL_19 = "DISPOSITIFS EXCLUS";
$multilang_TTYPERFORMANCEMODEL_22 = "variable manquante - 'MACHINE'";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TTYPERFORMANCEMODEL_1 = $multilang_CHECKWEIGHERMODEL_33;
$multilang_TTYPERFORMANCEMODEL_3 = $multilang_CHECKWEIGHERMODEL_32;
$multilang_TTYPERFORMANCEMODEL_4 = $multilang_CHECKWEIGHERMODEL_42;
$multilang_TTYPERFORMANCEMODEL_5 = $multilang_FAULT_39;
$multilang_TTYPERFORMANCEMODEL_6 = $multilang_STATIC_123;
$multilang_TTYPERFORMANCEMODEL_7 = $multilang_STATIC_FAULTS_CAPS;
$multilang_TTYPERFORMANCEMODEL_8 = $multilang_WARRIOR_60;
$multilang_TTYPERFORMANCEMODEL_9 = $multilang_SPFMODEL_46;
$multilang_TTYPERFORMANCEMODEL_10 = $multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF;
$multilang_TTYPERFORMANCEMODEL_11 = $multilang_CHECKWEIGHERMODEL_67;
$multilang_TTYPERFORMANCEMODEL_12 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TTYPERFORMANCEMODEL_13 = $multilang_SPFMODEL_15;
$multilang_TTYPERFORMANCEMODEL_14 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TTYPERFORMANCEMODEL_15 = $multilang_WARRIOR_86;
$multilang_TTYPERFORMANCEMODEL_17 = $multilang_WARRIOR_84;
$multilang_TTYPERFORMANCEMODEL_20 = $multilang_WARRIOR_103;
$multilang_TTYPERFORMANCEMODEL_21 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

?>
