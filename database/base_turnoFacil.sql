-- tables
-- Table: Adicional
CREATE TABLE Adicional (
    id int NOT NULL,
    Medico_id int NOT NULL,
    monto double NULL,
    CONSTRAINT Adicional_pk PRIMARY KEY (id)
);

-- Table: Medico
CREATE TABLE Medico (
    id int NOT NULL,
    Paciente_dni int NOT NULL,
    nombre varchar(30) NOT NULL,
    apellido varchar(30) NOT NULL,
    especialidad varchar(30) NOT NULL,
    dia date NOT NULL,
    hora time NOT NULL,
    CONSTRAINT Medico_pk PRIMARY KEY (id)
);

-- Table: ObraSocial
CREATE TABLE ObraSocial (
    id int NOT NULL,
    nombre varchar(30) NOT NULL,
    Medico_id int NOT NULL,
    CONSTRAINT ObraSocial_pk PRIMARY KEY (id)
);

-- Table: Paciente
CREATE TABLE Paciente (
    dni int NOT NULL,
    Medico_id int NOT NULL,
    nombre varchar(30) NOT NULL,
    apellido varchar(30) NOT NULL,
    direccion varchar(50) NOT NULL,
    email varchar(30) NOT NULL,
    obra_solcial varchar(30) NULL,
    numero_afiliado int NULL,
    CONSTRAINT dni PRIMARY KEY (dni)
);

-- foreign keys
-- Reference: Adicional_Medico (table: Adicional)
ALTER TABLE Adicional ADD CONSTRAINT Adicional_Medico FOREIGN KEY Adicional_Medico (Medico_id)
    REFERENCES Medico (id);

-- Reference: Medico_Paciente (table: Medico)
ALTER TABLE Medico ADD CONSTRAINT Medico_Paciente FOREIGN KEY Medico_Paciente (Paciente_dni)
    REFERENCES Paciente (dni);

-- Reference: ObraSocial_Medico (table: ObraSocial)
ALTER TABLE ObraSocial ADD CONSTRAINT ObraSocial_Medico FOREIGN KEY ObraSocial_Medico (Medico_id)
    REFERENCES Medico (id);

-- Reference: Paciente_Medico (table: Paciente)
ALTER TABLE Paciente ADD CONSTRAINT Paciente_Medico FOREIGN KEY Paciente_Medico (Medico_id)
    REFERENCES Medico (id);

-- End of file.