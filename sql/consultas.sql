SELECT AVG(diff)/9 FROM (SELECT month, MIN(cantidad) AS MIN, MAX(cantidad) AS MAX, MAX(cantidad)-MIN(cantidad) AS DIFF  FROM consumo GROUP BY month) AS summary;
SELECT * FROM precios_energia 
WHERE id_nodo IN ( SELECT id_nodo, COUNT(*) AS num_occurrences
                   FROM ( SELECT id_nodo, fecha, avg_daily_price, rank() OVER ( PARTITION BY fecha
                                                                                ORDER BY avg_daily_price DESC ) 
                                                                                FROM ( SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price
                                                                                       FROM precios_energia 
                                                                                       WHERE id_nodo LIKE '08%' 
                                                                                       GROUP BY id_nodo, fecha 
                                                                                     ) AS avg_daily_prices
                        ) AS rank_filter 
                   WHERE rank <= 10 
                   GROUP BY id_nodo 
                   ORDER BY num_occurrences DESC
                   LIMIT 10 
                 );

SELECT id_nodo FROM (SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo LIKE '01%' GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 5 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 5) AS top_nodes;

------
SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo LIKE '07%' AND id_nodo NOT IN ('07DOM-115','07GAO-115','07INS-115','07LAP-115','07LRO-115','07PES-115','07VIO-115','07BLE-115','07CAR-115','07COR-230','07ETR-115','07LPZ-115','07OLA-115','07PAA-115','07PUP-115','07RCO-115','07RFO-115','07ASJ-115','07CAB-115','07CAD-115','07CAF-115','07CAS-115','07CRE-115','07DLC-115','07PML-115','07SJC-115','07SNT-115','07TCB-115') GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 5 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 5;

SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo IN ('07DOM-115','07GAO-115','07INS-115','07LAP-115','07LRO-115','07PES-115','07VIO-115','07BLE-115','07CAR-115','07COR-230','07ETR-115','07LPZ-115','07OLA-115','07PAA-115','07PUP-115','07RCO-115','07RFO-115','07ASJ-115','07CAB-115','07CAD-115','07CAF-115','07CAS-115','07CRE-115','07DLC-115','07PML-115','07SJC-115','07SNT-115','07TCB-115') GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 5 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 5;
------

COPY (SELECT fecha,hora,id_nodo,precio_marginal FROM precios_energia WHERE id_nodo IN (SELECT id_nodo FROM (SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo LIKE '01%' GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 5 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 5) AS top_nodes)) TO '/tmp/datos01.csv' DELIMITER ',' CSV HEADER;
----
COPY (SELECT fecha,hora,id_nodo,precio_marginal FROM precios_energia WHERE id_nodo IN (SELECT id_nodo FROM (SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo IN ('07DOM-115','07GAO-115','07INS-115','07LAP-115','07LRO-115','07PES-115','07VIO-115','07BLE-115','07CAR-115','07COR-230','07ETR-115','07LPZ-115','07OLA-115','07PAA-115','07PUP-115','07RCO-115','07RFO-115','07ASJ-115','07CAB-115','07CAD-115','07CAF-115','07CAS-115','07CRE-115','07DLC-115','07PML-115','07SJC-115','07SNT-115','07TCB-115') GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 5 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 5) AS top_nodes)) TO '/tmp/datos07BCS.csv' DELIMITER ',' CSV HEADER;

COPY (SELECT fecha,hora,id_nodo,precio_marginal FROM precios_energia WHERE id_nodo IN (SELECT id_nodo FROM (SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo LIKE '07%' AND id_nodo NOT IN ('07DOM-115','07GAO-115','07INS-115','07LAP-115','07LRO-115','07PES-115','07VIO-115','07BLE-115','07CAR-115','07COR-230','07ETR-115','07LPZ-115','07OLA-115','07PAA-115','07PUP-115','07RCO-115','07RFO-115','07ASJ-115','07CAB-115','07CAD-115','07CAF-115','07CAS-115','07CRE-115','07DLC-115','07PML-115','07SJC-115','07SNT-115','07TCB-115') GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 10 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 10) AS top_nodes)) TO '/tmp/datos07BCA.csv' DELIMITER ',' CSV HEADER;
