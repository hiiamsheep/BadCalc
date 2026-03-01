import requests as R
import urllib.parse as U
import os as O
import threading as T

T.Thread(target=lambda: O.system("php -S 127.0.0.1:8001 > /dev/null 2>&1"), daemon=True).start()
i = input("Enter operation to evaluate : ")
response = R.get("http://127.0.0.1:8001/eval.php?in=" + U.quote(i))
j = response.json()
print("Result : " + j.get("result").replace("\n0", ""))
