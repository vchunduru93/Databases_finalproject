import mysql.connector

def main():
	cnx = mysql.connector.connect(user='cs41515_vsoonto1', password='SHRQKPKD',
	                              host='dbase.cs.jhu.edu',
	                              database='cs41515_vsoonto1_db')
	cursor = cnx.cursor()

	TRUNC = "TRUNCATE TABLE "
	tables = ['Course','Course_instance','Department','Department_affiliation','Professor']
	for table in tables:
		cursor.execute(TRUNC + table)
	cnx.commit()
	cursor.close()
	cnx.close()

main()
