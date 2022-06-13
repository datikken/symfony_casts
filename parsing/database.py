from sqlalchemy import create_engine, Column, Integer, String
from sqlalchemy.orm import sessionmaker
from sqlalchemy.ext.declarative import declarative_base
import pymysql

engine = create_engine('mysql+pymysql://root:password@127.0.0.1:53123/main', echo=False)

Session = sessionmaker(bind=engine)
session = Session()

Base = declarative_base()

class Link(Base):
    __tablename__ = 'link'
    id = Column(Integer, primary_key=True)
    url = Column(String(255))

Base.metadata.create_all(engine)