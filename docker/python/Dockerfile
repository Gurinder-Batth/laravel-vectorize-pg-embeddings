FROM python:3.9-slim

WORKDIR /app

RUN apt-get update && apt-get install -y \
    && pip install --no-cache-dir fastapi uvicorn sentence-transformers

COPY ./scripts /app/scripts/

EXPOSE 5001

CMD ["uvicorn", "scripts.app:app", "--host", "0.0.0.0", "--port", "5001"]
