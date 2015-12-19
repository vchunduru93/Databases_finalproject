import mysql.connector

cnx = mysql.connector.connect(user='cs41515_vsoonto1', password='SHRQKPKD',
                              host='dbase.cs.jhu.edu',
                              database='cs41515_vsoonto1_db')

query = ("")

cnx.close()
