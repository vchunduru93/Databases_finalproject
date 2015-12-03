import mysql.connector

cnx = mysql.connector.connect(user='cs41515_vchundu1', password='ZESHEHOW',
                              host='dbase.cs.jhu.edu',
                              database='cs41515_vchundu1_db')
cnx.close()
