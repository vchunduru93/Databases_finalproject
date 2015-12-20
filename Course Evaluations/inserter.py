import mysql.connector



def insert(evals, semester, year):
	cnx = mysql.connector.connect(user='cs41515_vsoonto1', password='SHRQKPKD',
	                              host='dbase.cs.jhu.edu',
	                              database='cs41515_vsoonto1_db')

	# Extract the features from each eval
	for evaluation in evals:
		dno, cno, cname, p_fname, p_lname,rating,summary = extract(evaluation)
		pid = insertProfessor(cnx,p_fname,p_lname)
		insertCourseInstance(cnx,dno,cno,semester,year,pid,rating,summary)
		insertCourse(cnx,dno,cno,cname)
		insertDepartmentAffiliation(cnx,pid,dno)


	cnx.close()

def extract(evaluation):
	lines = evaluation.splitlines()
	# extract dno, cno, NOTE: SAVE SECTION DETAILS FOR FUTURE
	dno,cno = lines[0].split('.')[1:3]
	# extract cname
	cname = lines[1]
	# extract p_fname, p_lname
	p_fname,p_lname = lines[2].split()
	# extract rating
	rating = lines[3].split(':')[-1].strip()
	# check whether summary or insufficient comments.
	if lines[4] == 'Summary:':
		summary = ''
		for line in lines[5:]:
			summary += line.strip() + ' '
	else:
		summary = lines[4]

	return dno, cno, cname, p_fname, p_lname,rating,summary

def insertProfessor(cnx,fname,lname):
	cursor = cnx.cursor()
	add_p = ("INSERT IGNORE INTO Professor "
               "(fname, lname) "
               "VALUES (%s, %s)")
	data_p = (fname,lname)
	# Insert new Professor
	cursor.execute(add_p,data_p)
	cnx.commit()

	query = ("SELECT pid FROM Professor "
         	 "WHERE fname=%s AND lname=%s")
	cursor.execute(query, (fname,lname))
	pid = cursor.fetchone()[0]

	cursor.close()

	return pid

def insertCourseInstance(cnx,dno,cno,semester,year,pid,rating,summary):
	cursor = cnx.cursor()
	add_ci = ("INSERT INTO Course_instance "
               "(dno,cno,semester,year,pid,rating,summary) "
               "VALUES (%s, %s, %s, %s, %s, %s, %s)")
	data_ci = (dno,cno,semester,year,pid,rating,summary)
	# Insert new Course Instance
	cursor.execute(add_ci,data_ci)
	cnx.commit()

	cursor.close()

def insertCourse(dno,cno,cname):
	cursor = cnx.cursor()
	add_c = ("INSERT IGNORE INTO  "
               "(dno,cno,cname) "
               "VALUES (%s, %s, %s)")
	data_c = (dno,cno,cname)
	# Insert Course
	cursor.execute(add_c,data_c)
	cnx.commit()

	cursor.close()

def insertDepartmentAffiliation(pid,dno):
	cursor = cnx.cursor()
	add_da = ("INSERT INTO  "
               "(pid,dno) "
               "VALUES (%s, %s)")
	data_da = (pid,dno)
	# Insert Department Affiliation
	cursor.execute(add_da,data_da)
	cnx.commit()

	cursor.close()
