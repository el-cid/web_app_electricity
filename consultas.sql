SELECT AVG(diff)/9 FROM (SELECT month, MIN(cantidad) AS MIN, MAX(cantidad) AS MAX, MAX(cantidad)-MIN(cantidad) AS DIFF  FROM consumo GROUP BY month) AS summary;
