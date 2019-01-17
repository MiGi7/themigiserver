#Michael Malinowski
#ID: 20572148
#CS116 Spring 2018 - Assignment 03 Question 1
#****************************************************

import check

def reorder_name(Names):
    '''
    reorder_name(Names) returns a string by extracting the first name, middle 
    name if present and last name, ordering it in "Last name, First name 
    followed by the first initial of the middle" if it is in the Names 
    parameter.
    
    reorder_name: Str -> Str
    
    Requires:
        Each individual name must be separated by a single empty space.
        Each name must have at least one character with no spaces
    
    Examples:
    
        reorder_name('Michael Malinowski') => Malinowski, Michael
        
        reorder_name('Michael Stanley Malinowski') => Malinowski, Michael S
    '''
    #determines if there is a middle name present
    if Names.rfind(' ') == Names.find(' '):
        return Names[Names.find(' ') + 1:] + ", " + Names[:Names.find(' ')]
    else:
        return Names[Names.rfind(' ') + 1:] + ", " + Names[:Names.find(' ')] +\
               Names[Names.find(' '):Names.find(' ') + 2]
        
#Tests:
check.expect('lower, no middle',(reorder_name('mike smith')),'smith, mike')

check.expect('lower, middle',(reorder_name('mike jim smith')),'smith, mike j')

check.expect('upper, no middle',(reorder_name('MIKE SMITH')),'SMITH, MIKE')

check.expect('upper, middle',(reorder_name('MIKE JIM SMITH')),'SMITH, MIKE J')

check.expect('mixed, no middle',(reorder_name('Mike Smith')),'Smith, Mike')

check.expect('Mixed, middle',(reorder_name('Mike Jim Smith')),'Smith, Mike J')

check.expect('singlechar',(reorder_name('m s')),'s, m')

check.expect('singlechar, middle',(reorder_name('M J S')),'S, M J')

check.expect('char',(reorder_name('M m S-s')),'S-s, M m')

check.expect('long name',(reorder_name('Michael Stanley Malinowski')),\
     'Malinowski, Michael S')

