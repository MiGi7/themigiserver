#Michael Malinowski
#ID: 20572148
#CS116 Spring 2018 - Assignment 04 Question 1
#****************************************************

import check
import math


#Part A.
#*******************************************************************************

def create_odds(target):
    '''
    create_odds(targets) returns a list of odd number that are
    less and/or equal to the target, a natural number.
    
    create_odds: Nat -> (listof Nat)
    
    Examples:
    
        create_odds(7) => [1,3,5,7]
    '''
    if target == 0:
        return []
    elif target <= 2:
        return [1]
    elif (target % 2) == 0:
        return create_odds(target - 3) + [target - 1]
    else:
        return create_odds(target - 2) + [target]
    
#Tests:

check.expect('target = 0', create_odds(0),[])

check.expect('target = 1', create_odds(1),[1])

check.expect('target = 2', create_odds(2),[1])

check.expect('target = 3', create_odds(3),[1,3])

check.expect('target = 10', create_odds(10),[1,3,5,7,9])

#Part B.
#*******************************************************************************

def build_special_list(n):
    '''
    build_special_list(n) returns a list of n lists containing single digit
    increments that stop at n. The range is 1-n with the exception of n=0 
    returns an empty list
    
    build_special_list: Nat -> (listof (listof Nat))
    
    Examples:
    
    build_special_list(1) => [[1]]
    
    build_special_list(2) =>[[1],[1,2]]
    '''
    
    if n == 0:
        return []
    elif n == 1:
        return [[1]]
    else:
        return build_special_list(n - 1) + [list(range(1, n + 1))]
    
#Tests:

check.expect('n=0',build_special_list(0), [])

check.expect('n=1',build_special_list(1), [[1]])

check.expect('n=3',build_special_list(3), [[1],[1,2],[1,2,3]])

#Part C.
#*******************************************************************************

def dis(n,x): 
    '''
    dis(n,x) returns a list of nat numbers that is divisible by n where every 
    number from the list has to be less than or equal to x.
    
    dis: Nat Nat -> (listof Nat)
    
    Examples:
    
        dis(16,16) => [1,2,4,8,16]
    '''
    if n <= 1:
        return []
    elif x == 0:
        return []
    elif x == 1:
        return [1]
    elif n % x == 0:
        return dis(n, x - 1) + [x]
    else:
        return dis(n,x - 1)
#Tests:

check.expect('16,16',dis(16,16),[1,2,4,8,16])

check.expect('16,0',dis(16,0),[])

check.expect('0,16',dis(0,16),[])

check.expect('16,4',dis(16,4),[1,2,4])
    

def divisibles(n):
    '''
    divisibles(n) returns a list of numbers less than n, that are divisible
    by n.
    
    divisibles: Nat -> (listof Nat)
    
    Examples:
    
        divisibles(4) => [1,2]
        
        divisibles(16) => [1,2,4,8]
    '''
    return dis(n,n - 1)
    
#Tests:

check.expect('n=0',divisibles(0),[])

check.expect('n=1',divisibles(1),[])

check.expect('n=16',divisibles(16),[1,2,4,8])

check.expect('n=19',divisibles(19),[1])

check.expect('n=21',divisibles(21),[1,3,7])

#Part D.
#*******************************************************************************

x = [1,2,3,2,4,2]


def list_counter(nlst,val,newval,x):
    '''
    list_counter(nlst,val,newval,x) returns the number of times val appears 
    in nlst. x determines where the replacement starts in the list
    Effects: the newval is replaced with every instance of val in nlst resulting
    in list mutation. 
    
    list_counter: (listof Int) Int Int Nat -> (listof Nat)
    
    Requires: 
         x <= len(nlst)
        
    Examples:
      
       if L = [1,2,3] then list_counter(L,2,'a',0) => 1 and 
       L = [1,'a',3]
       
       if L = [1,3,3] then list_counter(L,3,'b',0) => 2 and 
       L = [1,'b','b']
       
    '''
    if len(nlst) == x:
        return 0
    elif nlst[x] == val:
        nlst[x] = newval
        return 1 + list_counter(nlst, val,newval,x + 1)
    else:
        return 0 + list_counter(nlst, val,newval,x + 1)
    
#Test 1:
L = []
check.expect('t1',list_counter(L,'2','1',0),0)
check.expect('checking L',L,[])

#Test 2:
L = [1]
check.expect('t2',list_counter(L,'2','1',0),0)
check.expect('checking L',L,[1])

#Test 3:
L = [0,0,0]
check.expect('t3',list_counter(L,'2','1',0),0)
check.expect('checking L',L,[0,0,0])

#Test 4:
L = [1,2,3,2,4]
check.expect('t4',list_counter(L,2,1,0),2)
check.expect('checking L',L,[1,1,3,1,4])

#Test 5:
L = [1,2,3,2,4]
check.expect('t5',list_counter(L,2,1,3),1)
check.expect('checking L',L,[1,2,3,1,4])

#Test 6:
L = [1,2,3,2,4]
check.expect('t6',list_counter(L,2,1,5),0)
check.expect('checking L',L,[1,2,3,2,4])

#Test 7:
L = [1,2,3,2,4]
check.expect('t7',list_counter(L,2,1,0),2)
check.expect('checking L',L,[1,1,3,1,4])


    
def update_list(nlst,val,newval):
    '''
    update_list(nlst,val,newval) returns the number of times val appears 
    in nlst.
    Effects: the newval is replaced with every instance of val in nlst resulting
    in list mutation. 
    
    update_list: (listof Int) Int Int -> (listof Nat)
    
    Examples:
      
       if L = [1,2,3] then update_list(L,2,'a') => 1 and 
       L = [1,'a',3]
       
       if L = [1,3,3] then update_counter(L,3,'b') => 2 and 
       L = [1,'b','b']
       
    '''    
    return list_counter(nlst,val,newval,0)
    
#Test 1:
L = []
check.expect('t1',update_list(L,'2','1'),0)
check.expect('checking L',L,[])

#Test 2:
L = [1]
check.expect('t2',update_list(L,'2','1'),0)
check.expect('checking L',L,[1])

#Test 3:
L = [0,0,0]
check.expect('t3',update_list(L,'2','1'),0)
check.expect('checking L',L,[0,0,0])

#Test 4:
L = [1,2,3,2,4]
check.expect('t4',update_list(L,2,1),2)
check.expect('checking L',L,[1,1,3,1,4])

#Test 5:
L = ['w','w',1,3,4]
check.expect('t5',update_list(L,3,'HELLO'),1)
check.expect('checking L',L,['w','w',1,'HELLO',4])

    
#Part E.
#*******************************************************************************

a = [1,2,3,4,5]
b = [2,2,2,2,2]

def mult_list(m1,m2):
    '''
    mult_list(m1,m2) both lists are the same length and each component is
    multiplied.
    Effects: m1 is updated by multiplying the items in list two(m2). 
    multiplication occurs once for each item in m1 that match the index of the 
    items in m2

    mult_list: (listof Int) (listof Int) -> 
    
    Requires:
        m1 and m2 must be the same length
    
    Examples:
         
        if x = [1,2,3,4] and y = [2,2,2,2] then
        mult_list(x,y) => None, x = [2,4,6,8]
        
    '''
    if m2 == []:
        return
    else:
        m1[len(m2) - 1] = m1[len(m2) - 1] * m2[len(m2) - 1]
        mult_list(m1,m2[:-1])
        
#Test 1:
L1 = [1,2,3,4]
L2 = [2,2,2,2]
check.expect('t1',mult_list(L1,L2),None)
check.expect('checking L1',L1,[2,4,6,8])

#Test 2:
L1 = []
L2 = []
check.expect('t2',mult_list(L1,L2),None)
check.expect('checking L1',L1,[])

#Test 3:
L1 = [-1,-2,-3,-4]
L2 = [-2,-2,-2,-2]
check.expect('t3',mult_list(L1,L2),None)
check.expect('checking L1',L1,[2,4,6,8])

#Test 4:
L1 = [-1,-2,-3,-4]
L2 = [2,2,2,2]
check.expect('t1',mult_list(L1,L2),None)
check.expect('checking L1',L1,[-2,-4,-6,-8])

#Test 5:
L1 = [5,4,7,9]
L2 = [2,2,2,2]
check.expect('t5',mult_list(L1,L2),None)
check.expect('checking L1',L1,[10,8,14,18])

        