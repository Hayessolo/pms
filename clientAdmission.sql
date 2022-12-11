CREATE TABLE pms.clientAdmission (
	id INT auto_increment NOT NULL,
	clientId varchar(100) NULL,
	admissionNo varchar(100) NULL,
	admissionDate varchar(100) NULL,
	lengthStay varchar(100) NULL,
	dischargeDate varchar(100) NULL,
	primaryTherapist varchar(100) NULL,
	secondaryTherapist varchar(100) NULL,
	createdBy varchar(100) NULL,
	createdOn DATETIME NULL,
	modifiedBy varchar(100) NULL,
	modifiedOn DATETIME NULL,
	PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;
