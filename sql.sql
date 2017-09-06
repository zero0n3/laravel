--  sql di testo.php con 4 UNION;
--	PEZZI CHE NON SONO NEL MIO DB - DA COMPRARE TUTTI;
SELECT mio_moc01.Part     AS Part, 
       0_desc_parts.nome  AS DESCR, 
       0_colors.nome      AS Color, 
       0_colors.rgb       AS rgb, 
       mio_moc01.Quantity AS Quantity, 
       'XXX'              AS CAS 
FROM   ( ( mio_moc01 
         JOIN 0_desc_parts 
           ON ( ( 0_desc_parts.part_num = mio_moc01.Part ) ) ) 
         JOIN 0_colors 
           ON ( ( 0_colors.color_num = mio_moc01.Color ) ) ) 
WHERE  ( NOT ( EXISTS ( SELECT 1 
                        FROM   MIO_DB_LEGO 
                        WHERE  ( ( mio_moc01.Part = MIO_DB_LEGO.Part ) 
						AND ( mio_moc01.Color = MIO_DB_LEGO.Color ) ) ) ) ) 


--	UNION;
--	PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA DIFFERENZA DA COMPRARE;
UNION 


SELECT mio_moc01.Part                                AS Part, 
       0_desc_parts.nome                             AS DESCR, 
       0_colors.nome                                 AS Color, 
       0_colors.rgb                                  AS rgb, 
       ( mio_moc01.Quantity - MIO_DB_LEGO.Quantity ) AS Quantity, 
       'XXX'                                         AS CAS 
FROM   ( ( ( mio_moc01 
         JOIN MIO_DB_LEGO 
           ON ( ( ( mio_moc01.Part = MIO_DB_LEGO.Part ) 
           AND ( mio_moc01.Color = MIO_DB_LEGO.Color ) ) ) ) 
         JOIN 0_desc_parts 
           ON ( ( 0_desc_parts.part_num = mio_moc01.Part ) ) ) 
         JOIN 0_colors 
           ON ( ( 0_colors.color_num = mio_moc01.Color ) ) ) 
WHERE  ( ( mio_moc01.Quantity - MIO_DB_LEGO.Quantity ) > 0 ) 


--	UNION;
--	PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA MA NON SONO NEI PEZZI DA ORDINE - PEZZI UNICI CON SACCHETTO DEDICATO;
UNION 

	
SELECT mio_moc01.Part     AS Part, 
       0_desc_parts.nome  AS DESCR, 
       0_colors.nome      AS Color, 
       0_colors.rgb       AS rgb, 
       mio_moc01.Quantity AS Quantity, 
       0_cassettiera.cas  AS CAS 
FROM   mio_moc01 
           JOIN MIO_DB_LEGO 
             ON mio_moc01.Part = MIO_DB_LEGO.Part
             AND mio_moc01.Color = MIO_DB_LEGO.Color
           JOIN 0_desc_parts 
             ON 0_desc_parts.part_num = mio_moc01.Part 
           JOIN 0_colors 
             ON 0_colors.color_num = mio_moc01.Color
           JOIN 0_cassettiera 
             ON 0_cassettiera.part = mio_moc01.Part
WHERE  mio_moc01.Quantity - MIO_DB_LEGO.Quantity <= 0 AND mio_moc01.Part NOT IN (
								SELECT DISTINCT mio_moc01.Part
								FROM mio_moc01
								JOIN MIO_DB_LEGO ON mio_moc01.Part = MIO_DB_LEGO.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM MIO_DB_LEGO 
									WHERE mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color))
								
--	UNION;
--	PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA E HANNO UN CODICE UGUALE A QUELLI CHE ORDINO PER CUI DEVO TENERLI DA PARTE PRIMA DI CHUDERE I SACCHETTI;
UNION

SELECT Concat(mio_moc01.Part, ' ***')    AS Part, 
       0_desc_parts.nome  				 AS DESCR, 
       0_colors.nome      				 AS Color, 
       0_colors.rgb       				 AS rgb, 
       mio_moc01.Quantity 				 AS Quantity, 
       0_cassettiera.cas  				 AS CAS 
FROM   mio_moc01 
           JOIN MIO_DB_LEGO 
             ON mio_moc01.Part = MIO_DB_LEGO.Part
             AND mio_moc01.Color = MIO_DB_LEGO.Color
           JOIN 0_desc_parts 
             ON 0_desc_parts.part_num = mio_moc01.Part 
           JOIN 0_colors 
             ON 0_colors.color_num = mio_moc01.Color
           JOIN 0_cassettiera 
             ON 0_cassettiera.part = mio_moc01.Part
WHERE  mio_moc01.Quantity - MIO_DB_LEGO.Quantity <= 0 AND mio_moc01.Part IN (
								SELECT DISTINCT mio_moc01.Part
								FROM mio_moc01
								JOIN MIO_DB_LEGO ON mio_moc01.Part = MIO_DB_LEGO.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM MIO_DB_LEGO 
									WHERE mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color))	
	
	
	
	
	

--	UNION;
--	PEZZI CHE SONO NEL MIO DB E NON NE HO ABBASTANZA - QUI IMPOSTO LA QUANTITA' DEL MIO DB CHE ANDRò AD AZZERARE QUINDI;
UNION 


SELECT Concat(mio_moc01.Part, ' ***') AS Part, 
       0_desc_parts.nome              AS DESCR, 
       0_colors.nome                  AS Color, 
       0_colors.rgb                   AS rgb, 
       MIO_DB_LEGO.Quantity           AS Quantity, 
       0_cassettiera.cas              AS CAS 
FROM   ( ( ( ( mio_moc01 
           JOIN MIO_DB_LEGO 
             ON ( ( ( mio_moc01.Part = MIO_DB_LEGO.Part ) 
             AND ( mio_moc01.Color = MIO_DB_LEGO.Color ) ) ) ) 
		   JOIN 0_desc_parts 
			 ON ( ( 0_desc_parts.part_num = mio_moc01.Part ) ) ) 
		   JOIN 0_colors 
			 ON ( ( 0_colors.color_num = mio_moc01.Color ) ) ) 
		   JOIN 0_cassettiera 
			 ON ( ( 0_cassettiera.part = mio_moc01.Part ) ) ) 
WHERE  ( ( mio_moc01.Quantity - MIO_DB_LEGO.Quantity ) > 0 ) 


--	ORDER BY;
ORDER  BY CAS, 
          Part ASC;



	  
	  
	  
	  
	  
	  
	  
	  


	  
	  
--	SQL SEMPLICE PEZZI TOTALI 56
SELECT mio_moc01.Part
FROM mio_moc01
JOIN MIO_DB_LEGO ON mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color
WHERE mio_moc01.Quantity - MIO_DB_LEGO.Quantity <= 0;
	  
	  
	  
-- SQL SEMPLICE DEI PEZZI CHE NON HO	 43  
SELECT DISTINCT mio_moc01.Part
FROM mio_moc01
WHERE NOT EXISTS (
    SELECT 1
	FROM MIO_DB_LEGO 
	WHERE mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color);
	  
	  
	  


	  
--	SQL PEZZI DI CUI HO PARTI MA CHE NON SONO NELL'ELENCO DEI "NON HO" QUINDI SONO QUELLI DISTINTI FINALI
SELECT mio_moc01.Part
FROM mio_moc01
JOIN MIO_DB_LEGO ON mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color
WHERE mio_moc01.Quantity - MIO_DB_LEGO.Quantity <= 0
	AND mio_moc01.Part NOT IN (
								SELECT DISTINCT mio_moc01.Part
								FROM mio_moc01
								JOIN MIO_DB_LEGO ON mio_moc01.Part = MIO_DB_LEGO.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM MIO_DB_LEGO 
									WHERE mio_moc01.Part = MIO_DB_LEGO.Part AND mio_moc01.Color = MIO_DB_LEGO.Color)

);
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  






SELECT mio_moc01.chiave, mio_moc01.Part, mio_moc01.Color, mio_moc01.Quantity AS Quantity
FROM mio_moc01
WHERE NOT EXISTS (SELECT * FROM db_parts WHERE mio_moc01.chiave = db_parts.chiave)
UNION SELECT mio_moc01.chiave, mio_moc01.Part, mio_moc01.Color, (mio_moc01.Quantity - db_parts.Quantity) AS Quantity
FROM mio_moc01
INNER JOIN db_parts
ON mio_moc01.chiave = db_parts.chiave
WHERE (mio_moc01.Quantity - db_parts.Quantity) > 0
ORDER BY chiave;



SELECT mio_moc01.chiave, mio_moc01.Part, mio_moc01.Color, mio_moc01.Quantity AS Quantity
FROM mio_moc01 INNER JOIN db_parts ON mio_moc01.chiave = db_parts.chiave
WHERE (mio_moc01.Quantity-db_parts.Quantity) <= 0
UNION SELECT mio_moc01.chiave, mio_moc01.Part, mio_moc01.Color, db_parts.Quantity AS Quantity
FROM mio_moc01 INNER JOIN db_parts ON mio_moc01.chiave = db_parts.chiave
WHERE (mio_moc01.Quantity-db_parts.Quantity) > 0
ORDER BY chiave;



UPDATE db_parts
INNER JOIN add_parts01 ON db_parts.chiave = add_parts01.chiave
SET db_parts.Quantity = (db_parts.Quantity + add_parts01.Quantity);



select	`lego4ner_lego`.`mio_moc01`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`mio_moc01`.`Quantity` AS `Quantity`,
		`lego4ner_lego`.`0_cassettiera`.`cas` AS `CAS`
from (
		`lego4ner_lego`.`mio_moc01`
		join `lego4ner_lego`.`MIO_DB_LEGO` on((`lego4ner_lego`.`mio_moc01`.`chiave` = `lego4ner_lego`.`MIO_DB_LEGO`.`chiave`))
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`mio_moc01`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`mio_moc01`.`Color`))
		INNER JOIN `lego4ner_lego`.`0_cassettiera` ON((`lego4ner_lego`.`0_cassettiera`.`part` = `lego4ner_lego`.`mio_moc01`.`Part`))
		
		
	)
where (
	(`lego4ner_lego`.`mio_moc01`.`Quantity` - `lego4ner_lego`.`MIO_DB_LEGO`.`Quantity`) <= 0)


union

select	`lego4ner_lego`.`mio_moc01`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`MIO_DB_LEGO`.`Quantity` AS `Quantity`,
		`lego4ner_lego`.`0_cassettiera`.`cas` AS `CAS`
from (
		`lego4ner_lego`.`mio_moc01`
		join `lego4ner_lego`.`MIO_DB_LEGO` on((`lego4ner_lego`.`mio_moc01`.`chiave` = `lego4ner_lego`.`MIO_DB_LEGO`.`chiave`))
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`mio_moc01`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`mio_moc01`.`Color`))
		INNER JOIN `lego4ner_lego`.`0_cassettiera` ON((`lego4ner_lego`.`0_cassettiera`.`part` = `lego4ner_lego`.`mio_moc01`.`Part`))
	)
where (
	(`lego4ner_lego`.`mio_moc01`.`Quantity` - `lego4ner_lego`.`MIO_DB_LEGO`.`Quantity`) > 0) order by `CAS`,`Part`
	
	
	

	

BUY
	
select	`lego4ner_lego`.`mio_moc01`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`mio_moc01`.`Quantity` AS `Quantity`,
		"" AS `CAS`
from (
		`lego4ner_lego`.`mio_moc01`
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`mio_moc01`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`mio_moc01`.`Color`))
	)
where (
		not(exists(
					select 1 from `lego4ner_lego`.`MIO_DB_LEGO`
					where (`lego4ner_lego`.`mio_moc01`.`chiave` = `lego4ner_lego`.`MIO_DB_LEGO`.`chiave`))))

union

select	`lego4ner_lego`.`mio_moc01`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		(`lego4ner_lego`.`mio_moc01`.`Quantity` - `lego4ner_lego`.`MIO_DB_LEGO`.`Quantity`) AS `Quantity`,
		"" AS `CAS`

from (
		`lego4ner_lego`.`mio_moc01`
			join `lego4ner_lego`.`MIO_DB_LEGO` on((`lego4ner_lego`.`mio_moc01`.`chiave` = `lego4ner_lego`.`MIO_DB_LEGO`.`chiave`))
			INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`mio_moc01`.`Part`))
			INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`mio_moc01`.`Color`))
)
where (
		(`lego4ner_lego`.`mio_moc01`.`Quantity` - `lego4ner_lego`.`MIO_DB_LEGO`.`Quantity`) > 0) order by `Part`
		
		
		
		
		
		
		
		
		
		
		
		
$sql = "SELECT mio_moc01_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, mio_moc01_".$username_sql[username].".Quantity AS Quantity, 'XXX' AS CAS FROM ((mio_moc01_".$username_sql[username]." JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_".$username_sql[username].".Color ))) WHERE ( NOT( EXISTS(SELECT 1 FROM MIO_DB_LEGO_".$username_sql[username]." WHERE ( ( mio_moc01_".$username_sql[username].".Part = MIO_DB_LEGO_".$username_sql[username].".Part ) AND ( mio_moc01_".$username_sql[username].".Color = MIO_DB_LEGO_".$username_sql[username].".Color ) )) ) ) UNION SELECT mio_moc01_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ( mio_moc01_".$username_sql[username].".Quantity - MIO_DB_LEGO_".$username_sql[username].".Quantity ) AS Quantity, 'XXX' AS CAS FROM (((mio_moc01_".$username_sql[username]." JOIN MIO_DB_LEGO_".$username_sql[username]." ON(( ( mio_moc01_".$username_sql[username].".Part = MIO_DB_LEGO_".$username_sql[username].".Part ) AND ( mio_moc01_".$username_sql[username].".Color = MIO_DB_LEGO_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_".$username_sql[username].".Color ))) WHERE ( ( mio_moc01_".$username_sql[username].".Quantity - MIO_DB_LEGO_".$username_sql[username].".Quantity ) > 0 ) UNION SELECT mio_moc01_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, mio_moc01_".$username_sql[username].".Quantity AS Quantity, cassettiera_".$username_sql[username].".cas AS CAS FROM ((((mio_moc01_".$username_sql[username]." JOIN MIO_DB_LEGO_".$username_sql[username]." ON(( ( mio_moc01_".$username_sql[username].".Part = MIO_DB_LEGO_".$username_sql[username].".Part ) AND ( mio_moc01_".$username_sql[username].".Color = MIO_DB_LEGO_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_".$username_sql[username].".Color ))) JOIN cassettiera_".$username_sql[username]." ON(( cassettiera_".$username_sql[username].".part = mio_moc01_".$username_sql[username].".Part ))) WHERE ( ( mio_moc01_".$username_sql[username].".Quantity - MIO_DB_LEGO_".$username_sql[username].".Quantity ) <= 0 ) UNION SELECT Concat(mio_moc01_".$username_sql[username].".Part, ' ***') AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, MIO_DB_LEGO_".$username_sql[username].".Quantity AS Quantity, cassettiera_".$username_sql[username].".cas AS CAS FROM ((((mio_moc01_".$username_sql[username]." JOIN MIO_DB_LEGO_".$username_sql[username]." ON(( ( mio_moc01_".$username_sql[username].".Part = MIO_DB_LEGO_".$username_sql[username].".Part ) AND ( mio_moc01_".$username_sql[username].".Color = MIO_DB_LEGO_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_".$username_sql[username].".Color ))) JOIN cassettiera_".$username_sql[username]." ON(( cassettiera_".$username_sql[username].".part = mio_moc01_".$username_sql[username].".Part ))) WHERE ( ( mio_moc01_".$username_sql[username].".Quantity - MIO_DB_LEGO_".$username_sql[username].".Quantity ) > 0 ) ORDER BY CAS, Part";






$sql = "SELECT mio_moc01_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, mio_moc01_sbissi.Quantity AS Quantity, 'XXX' AS CAS FROM ((mio_moc01_sbissi JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_sbissi.Color ))) WHERE ( NOT( EXISTS(SELECT 1 FROM MIO_DB_LEGO_sbissi WHERE ( ( mio_moc01_sbissi.Part = MIO_DB_LEGO_sbissi.Part ) AND ( mio_moc01_sbissi.Color = MIO_DB_LEGO_sbissi.Color ) )) ) ) UNION SELECT mio_moc01_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ( mio_moc01_sbissi.Quantity - MIO_DB_LEGO_sbissi.Quantity ) AS Quantity, 'XXX' AS CAS FROM (((mio_moc01_sbissi JOIN MIO_DB_LEGO_sbissi ON(( ( mio_moc01_sbissi.Part = MIO_DB_LEGO_sbissi.Part ) AND ( mio_moc01_sbissi.Color = MIO_DB_LEGO_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_sbissi.Color ))) WHERE ( ( mio_moc01_sbissi.Quantity - MIO_DB_LEGO_sbissi.Quantity ) > 0 ) UNION SELECT mio_moc01_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, mio_moc01_sbissi.Quantity AS Quantity, cassettiera_sbissi.cas AS CAS FROM ((((mio_moc01_sbissi JOIN MIO_DB_LEGO_sbissi ON(( ( mio_moc01_sbissi.Part = MIO_DB_LEGO_sbissi.Part ) AND ( mio_moc01_sbissi.Color = MIO_DB_LEGO_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_sbissi.Color ))) JOIN cassettiera_sbissi ON(( cassettiera_sbissi.part = mio_moc01_sbissi.Part ))) WHERE ( ( mio_moc01_sbissi.Quantity - MIO_DB_LEGO_sbissi.Quantity ) <= 0 ) UNION SELECT Concat(mio_moc01_sbissi.Part, ' ***') AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, MIO_DB_LEGO_sbissi.Quantity AS Quantity, cassettiera_sbissi.cas AS CAS FROM ((((mio_moc01_sbissi JOIN MIO_DB_LEGO_sbissi ON(( ( mio_moc01_sbissi.Part = MIO_DB_LEGO_sbissi.Part ) AND ( mio_moc01_sbissi.Color = MIO_DB_LEGO_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = mio_moc01_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = mio_moc01_sbissi.Color ))) JOIN cassettiera_sbissi ON(( cassettiera_sbissi.part = mio_moc01_sbissi.Part ))) WHERE ( ( mio_moc01_sbissi.Quantity - MIO_DB_LEGO_sbissi.Quantity ) > 0 ) ORDER BY CAS, Part";