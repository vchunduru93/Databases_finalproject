''' 
Course Eval text  parser
Takes in filename to course eval raw text file, outputs each course eval separated by line breaks.

'''

import sys
import inserter

def removePageBreaks(fname):
	# Pass 1: remove page breaks
	
	f = open(fname, 'r')
	text = []
	c = 0

	for line in f:
		if c == 0:
			if len(line) <= 4: # then it is a new page, omit the following line
				c = 1
			else:
				text.append(line)
		elif c == 1: # skip this line
			c = 0

	f.close()
	return text

def extractTiming(text):
	line = text[2]
	semester,year = line.split()[6:]

	return semester,year

def removePreambles(text):
	text2 = []
	c = 0
	
	for line in text:
		if c == 0:
			if line[0:3] == 'AS.' or line[0:3] == 'EN.':
				text2.append(line)
				c = 1
		elif c == 1:
			if line == 'JOHNS HOPKINS UNIVERSITY' or line[0:4] == 'FALL' or line[0:6] == 'SPRING':
				c = 0
			else:
				text2.append(line)
	return text2

def splitCourseEvals(text2):
	# Pass 3: split each course eval up

	evals = []
	buff = ''

	for line in text2:
		if line[0:3] == 'AS.' or line[0:3] == 'EN.':
			evals.append(buff)
			buff = ''
		buff += line
	evals.append(buff)
	# remove the first element which is empty
	evals.pop(0)

	return evals


def main():

	text = removePageBreaks(sys.argv[1])
	semester,year = extractTiming(text)
	text2 = removePreambles(text)
	evals = splitCourseEvals(text2)
	inserter.insert(evals, semester, year)
	
#	for evaluation in evals:
#		print(evaluation)

main()

