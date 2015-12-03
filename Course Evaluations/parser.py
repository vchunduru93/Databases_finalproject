# Text parser

import sys

def main():

	# Pass 1: remove page breaks
	
	f = open(sys.argv[1], 'r')
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


	# Pass 2: remove preambles

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
	
	for evaluation in evals:
		print(evaluation)

main()

