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

COPY (SELECT fecha,hora,id_nodo,precio_marginal FROM precios_energia WHERE id_nodo IN (SELECT id_nodo FROM (SELECT id_nodo, COUNT(*) AS num_occurrences FROM (SELECT id_nodo, fecha, avg_daily_price, rank() OVER(PARTITION BY fecha ORDER BY avg_daily_price DESC) FROM (SELECT id_nodo, fecha, AVG(precio_marginal) AS avg_daily_price FROM precios_energia WHERE id_nodo LIKE '01%' GROUP BY id_nodo, fecha) AS avg_daily_prices) AS rank_filter WHERE rank <= 10 GROUP BY id_nodo ORDER BY num_occurrences DESC LIMIT 10) AS top_nodes)) TO '/tmp/datos01.csv' DELIMITER ',' CSV HEADER;
