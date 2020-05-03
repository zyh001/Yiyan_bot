from sklearn.feature_extraction.text import CountVectorizer
import numpy as np
import sys, re
from scipy.linalg import norm

def tf_similarity(s1, s2):
    def add_space(s):
        return ' '.join(list(s))
    s1, s2 = add_space(s1), add_space(s2)
    cv = CountVectorizer(tokenizer=lambda s: s.split())
    corpus = [s1, s2]
    vectors = cv.fit_transform(corpus).toarray()
    return np.dot(vectors[0], vectors[1]) / (norm(vectors[0]) * norm(vectors[1]))

def find_chinese(text):
    pattern = re.compile(r'[^\u4e00-\u9fa5]')
    chinese = re.sub(pattern, '', text)
    return chinese
with open(r'./db.txt','r') as tline:
        s1 = tline.readlines()
        s2 = sys.argv[1:]
        s3 = "".join([str(x) for x in s2])
        s5 = find_chinese(s3)
        for s in s1:
            s4 = find_chinese(s)
            a = tf_similarity(s4, s5)
            if a > 0.7:
                print('{} -> {}'.format(a,s))
                exit(0)

