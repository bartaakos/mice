# mice

There are two types of mice, left leaning (<) and right leaning (>)
ones. Six mice are initially arranged on seven slots in the following
configuration:

[>,>,>,_,<,<,<]

The empty slot is indicated by '_' and the task is to move all the
mice on the left to the right and all the mice on the right to the
left, as in:

[<,<,<,_,>,>,>]

The rules are simple:

1. A right leaning mouse (>) can only move to the right.
2. A left leaning mouse (<) can only move to the left.
3. A mouse can either move one step forward (left/right) to fill an
empty slot or jump over any one mouse (left or right leaning) to
occupy an empty slot.

```
Problem: [ >  >  >  _  <  <  < ] -> [ <  <  <  _  >  >  > ]

Solution:
Steps: 2, 4, 5, 3, 1, 0, 2, 4, 6, 5, 3, 1, 2, 4, 3

HandleStep 2 @ [ >  >  >  _  <  <  < ]
HandleStep 4 @ [ >  >  _  >  <  <  < ]
HandleStep 5 @ [ >  >  <  >  _  <  < ]
HandleStep 3 @ [ >  >  <  >  <  _  < ]
HandleStep 1 @ [ >  >  <  _  <  >  < ]
HandleStep 0 @ [ >  _  <  >  <  >  < ]
HandleStep 2 @ [ _  >  <  >  <  >  < ]
HandleStep 4 @ [ <  >  _  >  <  >  < ]
HandleStep 6 @ [ <  >  <  >  _  >  < ]
HandleStep 5 @ [ <  >  <  >  <  >  _ ]
HandleStep 3 @ [ <  >  <  >  <  _  > ]
HandleStep 1 @ [ <  >  <  _  <  >  > ]
HandleStep 2 @ [ <  _  <  >  <  >  > ]
HandleStep 4 @ [ <  <  _  >  <  >  > ]
HandleStep 3 @ [ <  <  <  >  _  >  > ]

[ <  <  <  _  >  >  > ]
```
