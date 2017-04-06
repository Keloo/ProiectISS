cms
===

A Symfony project created on April 5, 2017, 10:34 am.

##User groups:
1. ROLE_SUPER_ADMIN (system admin)
2. ROLE_PC (program committee)
3. ROLE_SPEAKER (user that submit paper)
4. ROLE_LISTENER (user that attend the event)
5. ROLE_REVIEWER (user that can evaluate papers)
6. ROLE_USER (the default role)

##General Specs:
1. System must manage many conferences, not only one!
2. Any users can register, then it's approved by the ROLE_SUPER_ADMIN
3. At least two ROLE_REVIEWER users must review a paper
4. Review options: strong accept, accept, weak accept, borderline paper, weak reject, reject and strong reject
5. Papers with no type of reject are accepted
6. Default number of evaluations per paper is 2.
7. In case of any contradictory evaluation, one more reviewer evaluate the paper and if it's not solved the ROLE_PC decide
8. Evaluation of papers is done in the "Call for papers" deadline
9. If paper is accepted then notify user via email. Email info: (general info + the reviewer's comments on improvement)
10. If any of user's paper is accepted in the "Call for papers" deadline then he's promoted to ROLE_SPEAKER

##Deadlines specs:
1. Deadline for specific conference
2. First deadline is the "Call for papers" where ROLE_SPEAKER users upload the abstract paper + meta info
3. Next deadline is "Paper submission" where accepted papers are uploaded in full versions + additional meta info

##User granted actions:
1. ROLE_SUPER_ADMIN: \
Accept, promote and demote users

2. ROLE_PC: \
CRUD for: conferences, deadlines, paper categories \
Promote and demote users except ROLE_SUPER_ADMIN

3. ROLE_REVIEWER: \
CRUD for: paper evaluation

4. ROLE_USER: \
CRUD for: abstract papers

5. ROLE_SPEAKER: \
CRUD for: full paper