1. Organisations

INSERT INTO organisations
(
    nom,
    code,
    email,
    telephone,
    adresse,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    'École La Réussite',
    'ELR',
    'contact@lareussite.cd',
    '066000001',
    'Brazzaville',
    'Établissement scolaire privé.',
    1,
    NOW(),
    NOW()
),
(
    'Groupe Scolaire Excellence',
    'GSE',
    'contact@excellence.cg',
    '066000002',
    'Brazzaville',
    'Groupe scolaire privé.',
    1,
    NOW(),
    NOW()
),
(
    'Complexe Scolaire Les Étoiles',
    'CSE',
    'contact@etoiles.cg',
    '066000003',
    'Pointe-Noire',
    'Complexe scolaire.',
    1,
    NOW(),
    NOW()
);


2. Sites

INSERT INTO sites
(
    organisation_id,
    nom,
    code,
    email,
    telephone,
    adresse,
    ville,
    pays,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    1,
    'Site Principal',
    'ELR-SP',
    'site1@lareussite.cg',
    '066100001',
    'Avenue de la Paix',
    'Brazzaville',
    'République du Congo',
    'Site principal de l’École La Réussite.',
    1,
    NOW(),
    NOW()
),
(
    1,
    'Site Nord',
    'ELR-SN',
    'sitenord@lareussite.cg',
    '066100002',
    'Quartier Nord',
    'Brazzaville',
    'République du Congo',
    'Second site de l’École La Réussite.',
    1,
    NOW(),
    NOW()
),
(
    2,
    'Site Principal',
    'GSE-SP',
    'site@gse.cg',
    '066100003',
    'Centre-ville',
    'Brazzaville',
    'République du Congo',
    'Site principal du Groupe Scolaire Excellence.',
    1,
    NOW(),
    NOW()
),
(
    3,
    'Site Principal',
    'CSE-SP',
    'site@etoiles.cg',
    '066100004',
    'Centre-ville',
    'Pointe-Noire',
    'République du Congo',
    'Site principal du Complexe Scolaire Les Étoiles.',
    1,
    NOW(),
    NOW()
);

3. Années scolaires

INSERT INTO annees_scolaires
(
    organisation_id,
    libelle,
    date_debut,
    date_fin,
    active,
    description,
    created_at,
    updated_at
)
VALUES
(
    1,
    '2025-2026',
    '2025-10-01',
    '2026-07-31',
    0,
    'Année scolaire 2025-2026.',
    NOW(),
    NOW()
),
(
    1,
    '2026-2027',
    '2026-10-01',
    '2027-07-31',
    1,
    'Année scolaire 2026-2027.',
    NOW(),
    NOW()
),
(
    1,
    '2027-2028',
    '2027-10-01',
    '2028-07-31',
    0,
    'Année scolaire 2027-2028.',
    NOW(),
    NOW()
),
(
    2,
    '2026-2027',
    '2026-10-01',
    '2027-07-31',
    1,
    'Année scolaire 2026-2027.',
    NOW(),
    NOW()
),
(
    3,
    '2026-2027',
    '2026-10-01',
    '2027-07-31',
    1,
    'Année scolaire 2026-2027.',
    NOW(),
    NOW()
);

4. Cycles

INSERT INTO cycles
(
    organisation_id,
    nom,
    code,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(1, 'Préscolaire', 'PRESCO', 'Cycle préscolaire.', 1, NOW(), NOW()),
(1, 'Primaire', 'PRIM', 'Cycle primaire.', 1, NOW(), NOW()),
(1, 'Collège', 'COLL', 'Cycle collège.', 1, NOW(), NOW()),
(1, 'Lycée', 'LYC', 'Cycle lycée.', 1, NOW(), NOW()),

(2, 'Préscolaire', 'PRESCO', 'Cycle préscolaire.', 1, NOW(), NOW()),
(2, 'Primaire', 'PRIM', 'Cycle primaire.', 1, NOW(), NOW()),
(2, 'Collège', 'COLL', 'Cycle collège.', 1, NOW(), NOW()),
(2, 'Lycée', 'LYC', 'Cycle lycée.', 1, NOW(), NOW()),

(3, 'Préscolaire', 'PRESCO', 'Cycle préscolaire.', 1, NOW(), NOW()),
(3, 'Primaire', 'PRIM', 'Cycle primaire.', 1, NOW(), NOW()),
(3, 'Collège', 'COLL', 'Cycle collège.', 1, NOW(), NOW()),
(3, 'Lycée', 'LYC', 'Cycle lycée.', 1, NOW(), NOW());

5. Niveaux

INSERT INTO niveaux
(
    cycle_id,
    nom,
    code,
    ordre,
    description,
    statut,
    created_at,
    updated_at
)
VALUES

-- Préscolaire
(1, 'Garderie', 'GARD', 1, 'Niveau de garderie.', 1, NOW(), NOW()),

-- Primaire
(2, 'CP1', 'CP1', 1, 'Cours Préparatoire 1.', 1, NOW(), NOW()),
(2, 'CP2', 'CP2', 2, 'Cours Préparatoire 2.', 1, NOW(), NOW()),
(2, 'CE1', 'CE1', 3, 'Cours Élémentaire 1.', 1, NOW(), NOW()),
(2, 'CE2', 'CE2', 4, 'Cours Élémentaire 2.', 1, NOW(), NOW()),
(2, 'CM1', 'CM1', 5, 'Cours Moyen 1.', 1, NOW(), NOW()),
(2, 'CM2', 'CM2', 6, 'Cours Moyen 2.', 1, NOW(), NOW()),

-- Collège
(3, '6e', '6E', 1, 'Classe de sixième.', 1, NOW(), NOW()),
(3, '5e', '5E', 2, 'Classe de cinquième.', 1, NOW(), NOW()),
(3, '4e', '4E', 3, 'Classe de quatrième.', 1, NOW(), NOW()),
(3, '3e', '3E', 4, 'Classe de troisième.', 1, NOW(), NOW()),

-- Lycée
(4, 'Seconde', '2ND', 1, 'Classe de seconde.', 1, NOW(), NOW()),
(4, 'Première', '1ERE', 2, 'Classe de première.', 1, NOW(), NOW()),
(4, 'Terminale', 'TLE', 3, 'Classe de terminale.', 1, NOW(), NOW());

6.Périodes scolaires

INSERT INTO periodes_scolaires
(
    annee_scolaire_id,
    nom,
    code,
    date_debut,
    date_fin,
    active,
    description,
    created_at,
    updated_at
)
VALUES
(
    2,
    'Premier trimestre',
    'T1',
    '2026-10-01',
    '2026-12-19',
    1,
    'Premier trimestre de l’année scolaire 2026-2027.',
    NOW(),
    NOW()
),
(
    2,
    'Deuxième trimestre',
    'T2',
    '2027-01-04',
    '2027-03-31',
    0,
    'Deuxième trimestre de l’année scolaire 2026-2027.',
    NOW(),
    NOW()
),
(
    2,
    'Troisième trimestre',
    'T3',
    '2027-04-01',
    '2027-07-31',
    0,
    'Troisième trimestre de l’année scolaire 2026-2027.',
    NOW(),
    NOW()
);

7. Groupes

INSERT INTO groupes
(
    niveau_id,
    nom,
    code,
    ordre,
    capacite,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    2,
    'CP1 A',
    'CP1-A',
    1,
    40,
    'Groupe CP1 A.',
    1,
    NOW(),
    NOW()
),
(
    2,
    'CP1 B',
    'CP1-B',
    2,
    40,
    'Groupe CP1 B.',
    1,
    NOW(),
    NOW()
),
(
    7,
    'CM2 A',
    'CM2-A',
    1,
    40,
    'Groupe CM2 A.',
    1,
    NOW(),
    NOW()
),
(
    7,
    'CM2 B',
    'CM2-B',
    2,
    40,
    'Groupe CM2 B.',
    1,
    NOW(),
    NOW()
);

INSERT INTO groupes
(
    niveau_id,
    nom,
    code,
    ordre,
    capacite,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    8,
    '6e A',
    '6E-A',
    1,
    45,
    'Groupe 6e A.',
    1,
    NOW(),
    NOW()
),
(
    8,
    '6e B',
    '6E-B',
    2,
    45,
    'Groupe 6e B.',
    1,
    NOW(),
    NOW()
),
(
    11,
    '3e A',
    '3E-A',
    1,
    45,
    'Groupe 3e A.',
    1,
    NOW(),
    NOW()
);

8. Salles

INSERT INTO salles
(
    site_id,
    nom,
    code,
    capacite,
    type,
    batiment,
    etage,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    1,
    'Salle CP1 A',
    'CP1-A',
    40,
    'Salle de classe',
    'Bâtiment A',
    'RDC',
    'Salle destinée au groupe CP1 A.',
    'disponible',
    NOW(),
    NOW()
),
(
    1,
    'Salle CP1 B',
    'CP1-B',
    40,
    'Salle de classe',
    'Bâtiment A',
    'RDC',
    'Salle destinée au groupe CP1 B.',
    'disponible',
    NOW(),
    NOW()
),
(
    1,
    'Salle CM2 A',
    'CM2-A',
    40,
    'Salle de classe',
    'Bâtiment A',
    '1er étage',
    'Salle destinée au groupe CM2 A.',
    'disponible',
    NOW(),
    NOW()
),
(
    1,
    'Salle CM2 B',
    'CM2-B',
    40,
    'Salle de classe',
    'Bâtiment A',
    '1er étage',
    'Salle destinée au groupe CM2 B.',
    'disponible',
    NOW(),
    NOW()
),
(
    1,
    'Laboratoire',
    'LAB-01',
    30,
    'Laboratoire',
    'Bâtiment B',
    'RDC',
    'Laboratoire scientifique.',
    'disponible',
    NOW(),
    NOW()
),
(
    1,
    'Salle informatique',
    'INFO-01',
    25,
    'Informatique',
    'Bâtiment B',
    '1er étage',
    'Salle informatique.',
    'maintenance',
    NOW(),
    NOW()
);

INSERT INTO salles
(
    site_id,
    nom,
    code,
    capacite,
    type,
    batiment,
    etage,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    2,
    'Salle 1',
    'S1-01',
    40,
    'Salle de classe',
    'Bâtiment A',
    'RDC',
    'Salle de classe du site Nord.',
    'disponible',
    NOW(),
    NOW()
),
(
    2,
    'Salle 2',
    'S1-02',
    40,
    'Salle de classe',
    'Bâtiment A',
    'RDC',
    'Salle de classe du site Nord.',
    'disponible',
    NOW(),
    NOW()
);

9. Classes

INSERT INTO classes
(
    site_id,
    annee_scolaire_id,
    groupe_id,
    salle_id,
    nom,
    code,
    effectif_max,
    description,
    statut,
    created_at,
    updated_at
)
VALUES
(
    1,
    2,
    1,
    1,
    'CP1 A',
    'CP1-A-2627',
    40,
    'Classe CP1 A pour l’année scolaire 2026-2027.',
    'ouverte',
    NOW(),
    NOW()
),
(
    1,
    2,
    2,
    2,
    'CP1 B',
    'CP1-B-2627',
    40,
    'Classe CP1 B pour l’année scolaire 2026-2027.',
    'ouverte',
    NOW(),
    NOW()
),
(
    1,
    2,
    3,
    3,
    'CM2 A',
    'CM2-A-2627',
    40,
    'Classe CM2 A pour l’année scolaire 2026-2027.',
    'ouverte',
    NOW(),
    NOW()
),
(
    1,
    2,
    4,
    4,
    'CM2 B',
    'CM2-B-2627',
    40,
    'Classe CM2 B pour l’année scolaire 2026-2027.',
    'ouverte',
    NOW(),
    NOW()
);


