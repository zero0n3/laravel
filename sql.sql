--  sql di testo.php con 4 UNION;
--	1	PEZZI CHE NON SONO NEL MIO DB - DA COMPRARE TUTTI;
SELECT lmocs.Part     AS Part, 
       0_desc_parts.nome  AS DESCR, 
       0_colors.nome      AS Color, 
       0_colors.rgb       AS rgb, 
       lmocs.Quantity AS Quantity, 
       'XXX'              AS CAS 
FROM   ( ( lmocs 
         JOIN 0_desc_parts 
           ON ( ( 0_desc_parts.part_num = lmocs.Part ) ) ) 
         JOIN 0_colors 
           ON ( ( 0_colors.color_num = lmocs.Color ) ) ) 
WHERE  ( NOT ( EXISTS ( SELECT 1 
                        FROM   ldblegos 
                        WHERE  ( ( lmocs.Part = ldblegos.Part ) 
						AND ( lmocs.Color = ldblegos.Color ) ) ) ) ) 


--	UNION;
--	2a	PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA DIFFERENZA DA COMPRARE;
UNION 


SELECT lmocs.Part                                AS Part, 
       0_desc_parts.nome                             AS DESCR, 
       0_colors.nome                                 AS Color, 
       0_colors.rgb                                  AS rgb, 
       ( lmocs.Quantity - ldblegos.Quantity ) AS Quantity, 
       'XXX'                                         AS CAS 
FROM   ( ( ( lmocs 
         JOIN ldblegos 
           ON ( ( ( lmocs.Part = ldblegos.Part ) 
           AND ( lmocs.Color = ldblegos.Color ) ) ) ) 
         JOIN 0_desc_parts 
           ON ( ( 0_desc_parts.part_num = lmocs.Part ) ) ) 
         JOIN 0_colors 
           ON ( ( 0_colors.color_num = lmocs.Color ) ) ) 
WHERE  ( ( lmocs.Quantity - ldblegos.Quantity ) > 0 ) 


--	UNION;
--	2b	PEZZI CHE SONO NEL MIO DB E NON NE HO ABBASTANZA - QUI IMPOSTO LA QUANTITA' DEL MIO DB CHE ANDRò AD AZZERARE QUINDI;
UNION 


SELECT Concat(lmocs.Part, ' ***') AS Part, 
       0_desc_parts.nome              AS DESCR, 
       0_colors.nome                  AS Color, 
       0_colors.rgb                   AS rgb, 
       ldblegos.Quantity           AS Quantity, 
       0_cassettiera.cas              AS CAS 
FROM   ( ( ( ( lmocs 
           JOIN ldblegos 
             ON ( ( ( lmocs.Part = ldblegos.Part ) 
             AND ( lmocs.Color = ldblegos.Color ) ) ) ) 
		   JOIN 0_desc_parts 
			 ON ( ( 0_desc_parts.part_num = lmocs.Part ) ) ) 
		   JOIN 0_colors 
			 ON ( ( 0_colors.color_num = lmocs.Color ) ) ) 
		   JOIN 0_cassettiera 
			 ON ( ( 0_cassettiera.part = lmocs.Part ) ) ) 
WHERE  ( ( lmocs.Quantity - ldblegos.Quantity ) > 0 ) 


--	UNION;
--	3a	PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA MA NON SONO NEI PEZZI DA ORDINE - PEZZI UNICI CON SACCHETTO DEDICATO;
UNION 

	
SELECT lmocs.Part     AS Part, 
       0_desc_parts.nome  AS DESCR, 
       0_colors.nome      AS Color, 
       0_colors.rgb       AS rgb, 
       lmocs.Quantity AS Quantity, 
       0_cassettiera.cas  AS CAS 
FROM   lmocs 
           JOIN ldblegos 
             ON lmocs.Part = ldblegos.Part
             AND lmocs.Color = ldblegos.Color
           JOIN 0_desc_parts 
             ON 0_desc_parts.part_num = lmocs.Part 
           JOIN 0_colors 
             ON 0_colors.color_num = lmocs.Color
           JOIN 0_cassettiera 
             ON 0_cassettiera.part = lmocs.Part
WHERE  lmocs.Quantity - ldblegos.Quantity <= 0 AND lmocs.Part NOT IN (
								SELECT DISTINCT lmocs.Part
								FROM lmocs
								JOIN ldblegos ON lmocs.Part = ldblegos.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM ldblegos 
									WHERE lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color))
								
--	UNION;
--	3b	PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA E HANNO UN CODICE UGUALE A QUELLI CHE ORDINO PER CUI DEVO TENERLI DA PARTE PRIMA DI CHUDERE I SACCHETTI;
UNION

SELECT Concat(lmocs.Part, ' ***')    AS Part, 
       0_desc_parts.nome  				 AS DESCR, 
       0_colors.nome      				 AS Color, 
       0_colors.rgb       				 AS rgb, 
       lmocs.Quantity 				 AS Quantity, 
       0_cassettiera.cas  				 AS CAS 
FROM   lmocs 
           JOIN ldblegos 
             ON lmocs.Part = ldblegos.Part
             AND lmocs.Color = ldblegos.Color
           JOIN 0_desc_parts 
             ON 0_desc_parts.part_num = lmocs.Part 
           JOIN 0_colors 
             ON 0_colors.color_num = lmocs.Color
           JOIN 0_cassettiera 
             ON 0_cassettiera.part = lmocs.Part
WHERE  lmocs.Quantity - ldblegos.Quantity <= 0 AND lmocs.Part IN (
								SELECT DISTINCT lmocs.Part
								FROM lmocs
								JOIN ldblegos ON lmocs.Part = ldblegos.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM ldblegos 
									WHERE lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color))	
	
	


--	ORDER BY;
ORDER  BY CAS, 
          Part ASC;



	  
	  
	  
	  
	  
	  
	  
	  


	  
	  
--	SQL SEMPLICE PEZZI TOTALI 56
SELECT lmocs.Part
FROM lmocs
JOIN ldblegos ON lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color
WHERE lmocs.Quantity - ldblegos.Quantity <= 0;
	  
	  
	  
-- SQL SEMPLICE DEI PEZZI CHE NON HO	 43  
SELECT DISTINCT lmocs.Part
FROM lmocs
WHERE NOT EXISTS (
    SELECT 1
	FROM ldblegos 
	WHERE lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color);
	  
	  
	  


	  
--	SQL PEZZI DI CUI HO PARTI MA CHE NON SONO NELL'ELENCO DEI "NON HO" QUINDI SONO QUELLI DISTINTI FINALI
SELECT lmocs.Part
FROM lmocs
JOIN ldblegos ON lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color
WHERE lmocs.Quantity - ldblegos.Quantity <= 0
	AND lmocs.Part NOT IN (
								SELECT DISTINCT lmocs.Part
								FROM lmocs
								JOIN ldblegos ON lmocs.Part = ldblegos.Part 
								WHERE NOT EXISTS (
									SELECT 1
									FROM ldblegos 
									WHERE lmocs.Part = ldblegos.Part AND lmocs.Color = ldblegos.Color)

);
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  






SELECT lmocs.chiave, lmocs.Part, lmocs.Color, lmocs.Quantity AS Quantity
FROM lmocs
WHERE NOT EXISTS (SELECT * FROM db_parts WHERE lmocs.chiave = db_parts.chiave)
UNION SELECT lmocs.chiave, lmocs.Part, lmocs.Color, (lmocs.Quantity - db_parts.Quantity) AS Quantity
FROM lmocs
INNER JOIN db_parts
ON lmocs.chiave = db_parts.chiave
WHERE (lmocs.Quantity - db_parts.Quantity) > 0
ORDER BY chiave;



SELECT lmocs.chiave, lmocs.Part, lmocs.Color, lmocs.Quantity AS Quantity
FROM lmocs INNER JOIN db_parts ON lmocs.chiave = db_parts.chiave
WHERE (lmocs.Quantity-db_parts.Quantity) <= 0
UNION SELECT lmocs.chiave, lmocs.Part, lmocs.Color, db_parts.Quantity AS Quantity
FROM lmocs INNER JOIN db_parts ON lmocs.chiave = db_parts.chiave
WHERE (lmocs.Quantity-db_parts.Quantity) > 0
ORDER BY chiave;



UPDATE db_parts
INNER JOIN add_parts01 ON db_parts.chiave = add_parts01.chiave
SET db_parts.Quantity = (db_parts.Quantity + add_parts01.Quantity);



select	`lego4ner_lego`.`lmocs`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`lmocs`.`Quantity` AS `Quantity`,
		`lego4ner_lego`.`0_cassettiera`.`cas` AS `CAS`
from (
		`lego4ner_lego`.`lmocs`
		join `lego4ner_lego`.`ldblegos` on((`lego4ner_lego`.`lmocs`.`chiave` = `lego4ner_lego`.`ldblegos`.`chiave`))
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`lmocs`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`lmocs`.`Color`))
		INNER JOIN `lego4ner_lego`.`0_cassettiera` ON((`lego4ner_lego`.`0_cassettiera`.`part` = `lego4ner_lego`.`lmocs`.`Part`))
		
		
	)
where (
	(`lego4ner_lego`.`lmocs`.`Quantity` - `lego4ner_lego`.`ldblegos`.`Quantity`) <= 0)


union

select	`lego4ner_lego`.`lmocs`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`ldblegos`.`Quantity` AS `Quantity`,
		`lego4ner_lego`.`0_cassettiera`.`cas` AS `CAS`
from (
		`lego4ner_lego`.`lmocs`
		join `lego4ner_lego`.`ldblegos` on((`lego4ner_lego`.`lmocs`.`chiave` = `lego4ner_lego`.`ldblegos`.`chiave`))
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`lmocs`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`lmocs`.`Color`))
		INNER JOIN `lego4ner_lego`.`0_cassettiera` ON((`lego4ner_lego`.`0_cassettiera`.`part` = `lego4ner_lego`.`lmocs`.`Part`))
	)
where (
	(`lego4ner_lego`.`lmocs`.`Quantity` - `lego4ner_lego`.`ldblegos`.`Quantity`) > 0) order by `CAS`,`Part`
	
	
	

	

BUY
	
select	`lego4ner_lego`.`lmocs`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		`lego4ner_lego`.`lmocs`.`Quantity` AS `Quantity`,
		"" AS `CAS`
from (
		`lego4ner_lego`.`lmocs`
		INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`lmocs`.`Part`))
		INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`lmocs`.`Color`))
	)
where (
		not(exists(
					select 1 from `lego4ner_lego`.`ldblegos`
					where (`lego4ner_lego`.`lmocs`.`chiave` = `lego4ner_lego`.`ldblegos`.`chiave`))))

union

select	`lego4ner_lego`.`lmocs`.`Part` AS `Part`,
		`lego4ner_lego`.`0_desc_parts`.`nome` AS `DESCR`,
		`lego4ner_lego`.`0_colors`.`nome` AS `Color`,
		(`lego4ner_lego`.`lmocs`.`Quantity` - `lego4ner_lego`.`ldblegos`.`Quantity`) AS `Quantity`,
		"" AS `CAS`

from (
		`lego4ner_lego`.`lmocs`
			join `lego4ner_lego`.`ldblegos` on((`lego4ner_lego`.`lmocs`.`chiave` = `lego4ner_lego`.`ldblegos`.`chiave`))
			INNER JOIN `lego4ner_lego`.`0_desc_parts` ON((`lego4ner_lego`.`0_desc_parts`.`part_num` = `lego4ner_lego`.`lmocs`.`Part`))
			INNER JOIN `lego4ner_lego`.`0_colors` ON((`lego4ner_lego`.`0_colors`.`color_num` = `lego4ner_lego`.`lmocs`.`Color`))
)
where (
		(`lego4ner_lego`.`lmocs`.`Quantity` - `lego4ner_lego`.`ldblegos`.`Quantity`) > 0) order by `Part`
		
		
		
		
		
		
		
		
		
		
		
		
$sql = "SELECT lmocs_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, lmocs_".$username_sql[username].".Quantity AS Quantity, 'XXX' AS CAS FROM ((lmocs_".$username_sql[username]." JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_".$username_sql[username].".Color ))) WHERE ( NOT( EXISTS(SELECT 1 FROM ldblegos_".$username_sql[username]." WHERE ( ( lmocs_".$username_sql[username].".Part = ldblegos_".$username_sql[username].".Part ) AND ( lmocs_".$username_sql[username].".Color = ldblegos_".$username_sql[username].".Color ) )) ) ) UNION SELECT lmocs_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ( lmocs_".$username_sql[username].".Quantity - ldblegos_".$username_sql[username].".Quantity ) AS Quantity, 'XXX' AS CAS FROM (((lmocs_".$username_sql[username]." JOIN ldblegos_".$username_sql[username]." ON(( ( lmocs_".$username_sql[username].".Part = ldblegos_".$username_sql[username].".Part ) AND ( lmocs_".$username_sql[username].".Color = ldblegos_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_".$username_sql[username].".Color ))) WHERE ( ( lmocs_".$username_sql[username].".Quantity - ldblegos_".$username_sql[username].".Quantity ) > 0 ) UNION SELECT lmocs_".$username_sql[username].".Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, lmocs_".$username_sql[username].".Quantity AS Quantity, cassettiera_".$username_sql[username].".cas AS CAS FROM ((((lmocs_".$username_sql[username]." JOIN ldblegos_".$username_sql[username]." ON(( ( lmocs_".$username_sql[username].".Part = ldblegos_".$username_sql[username].".Part ) AND ( lmocs_".$username_sql[username].".Color = ldblegos_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_".$username_sql[username].".Color ))) JOIN cassettiera_".$username_sql[username]." ON(( cassettiera_".$username_sql[username].".part = lmocs_".$username_sql[username].".Part ))) WHERE ( ( lmocs_".$username_sql[username].".Quantity - ldblegos_".$username_sql[username].".Quantity ) <= 0 ) UNION SELECT Concat(lmocs_".$username_sql[username].".Part, ' ***') AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ldblegos_".$username_sql[username].".Quantity AS Quantity, cassettiera_".$username_sql[username].".cas AS CAS FROM ((((lmocs_".$username_sql[username]." JOIN ldblegos_".$username_sql[username]." ON(( ( lmocs_".$username_sql[username].".Part = ldblegos_".$username_sql[username].".Part ) AND ( lmocs_".$username_sql[username].".Color = ldblegos_".$username_sql[username].".Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_".$username_sql[username].".Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_".$username_sql[username].".Color ))) JOIN cassettiera_".$username_sql[username]." ON(( cassettiera_".$username_sql[username].".part = lmocs_".$username_sql[username].".Part ))) WHERE ( ( lmocs_".$username_sql[username].".Quantity - ldblegos_".$username_sql[username].".Quantity ) > 0 ) ORDER BY CAS, Part";






$sql = "SELECT lmocs_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, lmocs_sbissi.Quantity AS Quantity, 'XXX' AS CAS FROM ((lmocs_sbissi JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_sbissi.Color ))) WHERE ( NOT( EXISTS(SELECT 1 FROM ldblegos_sbissi WHERE ( ( lmocs_sbissi.Part = ldblegos_sbissi.Part ) AND ( lmocs_sbissi.Color = ldblegos_sbissi.Color ) )) ) ) UNION SELECT lmocs_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ( lmocs_sbissi.Quantity - ldblegos_sbissi.Quantity ) AS Quantity, 'XXX' AS CAS FROM (((lmocs_sbissi JOIN ldblegos_sbissi ON(( ( lmocs_sbissi.Part = ldblegos_sbissi.Part ) AND ( lmocs_sbissi.Color = ldblegos_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_sbissi.Color ))) WHERE ( ( lmocs_sbissi.Quantity - ldblegos_sbissi.Quantity ) > 0 ) UNION SELECT lmocs_sbissi.Part AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, lmocs_sbissi.Quantity AS Quantity, cassettiera_sbissi.cas AS CAS FROM ((((lmocs_sbissi JOIN ldblegos_sbissi ON(( ( lmocs_sbissi.Part = ldblegos_sbissi.Part ) AND ( lmocs_sbissi.Color = ldblegos_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_sbissi.Color ))) JOIN cassettiera_sbissi ON(( cassettiera_sbissi.part = lmocs_sbissi.Part ))) WHERE ( ( lmocs_sbissi.Quantity - ldblegos_sbissi.Quantity ) <= 0 ) UNION SELECT Concat(lmocs_sbissi.Part, ' ***') AS Part, 0_desc_parts.nome AS DESCR, 0_colors.nome AS Color, 0_colors.rgb AS rgb, ldblegos_sbissi.Quantity AS Quantity, cassettiera_sbissi.cas AS CAS FROM ((((lmocs_sbissi JOIN ldblegos_sbissi ON(( ( lmocs_sbissi.Part = ldblegos_sbissi.Part ) AND ( lmocs_sbissi.Color = ldblegos_sbissi.Color ) ))) JOIN 0_desc_parts ON(( 0_desc_parts.part_num = lmocs_sbissi.Part ))) JOIN 0_colors ON(( 0_colors.color_num = lmocs_sbissi.Color ))) JOIN cassettiera_sbissi ON(( cassettiera_sbissi.part = lmocs_sbissi.Part ))) WHERE ( ( lmocs_sbissi.Quantity - ldblegos_sbissi.Quantity ) > 0 ) ORDER BY CAS, Part";
