from fastapi import FastAPI, HTTPException
from sentence_transformers import SentenceTransformer
import json

app = FastAPI()
model = SentenceTransformer("all-MiniLM-L6-v2")  # Load model once

@app.get("/")
def home():
    return {"message": "Embedding Service Running"}

@app.post("/generate_embedding/")
async def generate_embedding(data: dict):
    try:
        text = data.get("text", "").strip()
        if not text:
            raise HTTPException(status_code=400, detail="Text is required")
        
        embedding = model.encode(text).tolist()
        return {"embedding": embedding}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
