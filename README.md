# affectiva-ad
This project combines with Affectiva and D3. It is the tool for studying the customers' behaviors by affective computing. While users are watching the advertisement, Affectiva will collect the facial expression data and pass them to D3 for data visualization. Later, researchers can explore the relationship between users facial expression and decisions of consumption.

## Getting Started
This web sets up on XAMPP. However, any php server will work for this project. Mysql database is also required for data storing. Thus, please confirm the setup of MySQL database.

### Prerequisites
* PHP server software (Recommand to use [XAMPP](https://www.apachefriends.org/index.html). And, this tutorial is using XAMPP)
* MySQL server software (if you choose to use XAMPP, it will be already for you)

### Installing
Download and install [XAMPP] (https://www.apachefriends.org/download.html)

Clone https://github.com/Hierifer/affectiva-ad to your XAMPP folder (e.x. folder path "C:\xampp\htdocs\dashboard" for Windows users; under dashboard folder for MAC users)

Setup your MySQL database by starting Apache on XMAPP Control Panel and goto "http://localhost/phpmyadmin".

Create a database called youtube and create a table. You can either use UI or c&p the below MySQL comment.

```
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
```
## Running the demo

Making sure both Apache and MySQL are active on XAMPP Control Panel.

Demo will run on "http://localhost/dashboard/affectiva-ad".

## Built With
* [Affectiva](http://www.affectiva.com/) - Affectiva
* [D3-Donut](http://bl.ocks.org/juan-cb/1984c7f2b446fffeedde) - Arthor: juancb
* [D3-Line](http://bl.ocks.org/DStruths/9c042e3a6b66048b5bd4) - Arthor: DStruths


## Author
* **Teng Hu** - *Initial work* - Email: thu4@dons.usfca.edu

## Acknowledgments
* Affectiva
* Jeremiad Raymond
