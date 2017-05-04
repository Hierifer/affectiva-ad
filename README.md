# affectiva-ad


CREATE TABLE video (
	email VARCHAR(30) NOT NULL,
	video VARCHAR(30) NOT NULL,
	joy int(10) NOT NULL,
	sad int(10) NOT NULL,
	disgust int(10) NOT NULL,
	contempt int(10) NOT NULL,
	anger int(10) NOT NULL,
	fear int(10) NOT NULL,
	surprise int(10) NOT NULL,
	nonemotion int(10) NOT NULL,
	engagement int(10) NOT NULL,
	distract int(10) NOT NULL,
	pvalence int(10) NOT NULL,
	nvalence int(10) NOT NULL,
	total int(10) NOT NULL,
	q1 int(1) NOT NULL,
	q2 int(1) NOT NULL,
	q3 int(1) NOT NULL   
)CHARACTER SET utf8 COLLATE utf8_unicode_ci;
