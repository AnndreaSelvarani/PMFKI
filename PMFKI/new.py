import csv
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn import naive_bayes
from sklearn.metrics import accuracy_score
from sklearn import metrics
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn import svm
from sklearn.cluster import KMeans
from nltk.tokenize import RegexpTokenizer
from nltk.stem import WordNetLemmatizer
from nltk.stem.porter import PorterStemmer
from nltk.corpus import stopwords
import matplotlib.pyplot as plt


df = pd.read_csv('test_all.csv', encoding='cp1252')

#instantiate Tokenizer
tokenizer = RegexpTokenizer(r'\w+')
df.text = df.text.apply(lambda x : tokenizer.tokenize(x.lower()))

#remove stop words
def remove_stopwords(text):
    words = [w for w in text if w not in stopwords.words('english')]
    return words
df.text = df.text.apply(lambda x :remove_stopwords(x))

#Instantiate lemmatizer
lemmatizer = WordNetLemmatizer()
def word_lemmatizer(text):
    lem_text = [lemmatizer.lemmatize(i) for i in text]
    return lem_text
df.text = df.text.apply(lambda x: word_lemmatizer(x))

#Instantite stemmer
stemmer = PorterStemmer()
def word_stemmer(text):
    stem_text = " ".join([stemmer.stem(i) for i in text])
    return stem_text
df.text = df.text.apply(lambda x: word_stemmer(x))
#print(df.text)

print(df.text.value_counts().head(20))

#feature extraction
tf = TfidfVectorizer()
text_tf = tf.fit_transform(df.text)

#split test and training set
x_train, x_test, y_train, y_test = train_test_split(text_tf, df['score'], test_size=0.2, random_state=123)

#naive bayes
clf_nb = naive_bayes.MultinomialNB().fit(x_train, y_train)
predict_nb = clf_nb.predict(x_test)

#svm
clf_svm = svm.SVC(kernel='linear')
clf_svm.fit(x_train, y_train)
predict_svm = clf_svm.predict(x_test)

#clustering
clf_c = KMeans(n_clusters=2)
clf_c.fit(x_train, y_train)
predict_c = clf_c.predict(x_test)

#print out accuracy
#print("accuracy of naive bayes:" , metrics.accuracy_score(y_test, predict_nb)*100)
#print("accuracy of svm:" , metrics.accuracy_score(y_test, predict_svm)*100)
#print("accuracy of clustering:" , metrics.accuracy_score(y_test, predict_c)*100)

#connect to mysql
import mysql.connector

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="pmfki"
    )

content = []
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM feedback")
myresult = mycursor.fetchall()
data = pd.DataFrame(myresult, columns = ['feedback','event'])

ser = data['feedback']
feedback = data['feedback']
event = data['event']

#instantiate Tokenizer
tokenizer = RegexpTokenizer(r'\w+')
ser = ser.apply(lambda x : tokenizer.tokenize(x.lower()))

#remove stop words
def remove_stopwords(text):
    words = [w for w in text if w not in stopwords.words('english')]
    return words
ser = ser.apply(lambda x :remove_stopwords(x))

#Instantiate lemmatizer
lemmatizer = WordNetLemmatizer()
def word_lemmatizer(text):
    lem_text = [lemmatizer.lemmatize(i) for i in text]
    return lem_text
ser = ser.apply(lambda x: word_lemmatizer(x))

#Instantite stemmer
stemmer = PorterStemmer()
def word_stemmer(text):
    stem_text = " ".join([stemmer.stem(i) for i in text])
    return stem_text
ser = ser.apply(lambda x: word_stemmer(x))

ser_vector = tf.transform(ser)

#predict sentiment of feedback
result = clf_svm.predict(ser_vector)
idx = pd.Series(result)
my_dict={0: 'Neutral', 1:'Positive', -1:'Negative'}
idx = [my_dict[idxi] for idxi in idx]
idx = pd.Index(idx)

#combining dataframes 
df1 = pd.DataFrame(feedback, columns = ['feedback'])
df = pd.DataFrame(idx, columns =['score'])
df2 = pd.DataFrame(event, columns=['event']) 
df_result = df.join(df1)
df = df_result.join(df2)
print (df)

#generate pie chart based on overall 
cdict = {"Positive": "green", "Negative": "red", "Neutral": "yellow"}
colors = [cdict[x] for x in df.score]
count_1 = df.score.value_counts()
count_1.plot.pie(figsize=(7,5), autopct='%1.1f%%')
plt.legend(title='score', bbox_to_anchor=(1.05,1), loc='upper left')
plt.xlabel('Sentiment Score')
plt.ylabel('')
plt.tight_layout()
plt.savefig(r'C:\xampp\htdocs\PMFKI\my_plot.png')

#generate bar chart based on events
count = df.groupby(['event']).score.value_counts().unstack()
count.plot.bar(figsize=(7,5))
plt.legend(title='score', bbox_to_anchor=(1.05,1), loc='upper left')
plt.xlabel('Event Name')
plt.xticks(rotation='horizontal')
plt.ylabel('Count')
plt.locator_params(axis='y', integer=True)
plt.tight_layout()
plt.savefig(r'C:\xampp\htdocs\PMFKI\my_plot_1.png')

#insert into sql
from sqlalchemy import create_engine
engine = create_engine("mysql+pymysql://{user}:{pw}@localhost/{db}".format(user="root",pw="",db="pmfki"))
df.to_sql('feedback_result', con = engine, if_exists = 'replace', chunksize = 1000, index=False)
                                                                           
