from django.db.models import *
from .models import *
import datetime
from dateutil.relativedelta import relativedelta
from django.db.models.functions import *

# Az összes az adatbázisban nyílvántartott költség
def OsszKoltseg():
    ertek = 0
    koltseg = szamlatetel.objects.aggregate(koltseg=Sum("brutto"))
    ertek = round(koltseg.get('koltseg'), 0)
    return ertek

# Az utolsó raHonap költsége
def getEvHonapKoltseg(raHonap):
    end = datetime.date.today() + relativedelta(days=1)
    start = end + relativedelta(months =- raHonap)
    results = szamlatetel.objects.filter(szamla__kelt__range=(start, end)) \
                                 .annotate(ev = ExtractYear('szamla__kelt'), honap=ExtractMonth('szamla__kelt')) \
                                 .values('ev', 'honap') \
                                 .annotate(db = Sum('brutto')) \
                                 .order_by('ev', 'honap')
    return results

# Az utolsó raHet költsége
def getEvHetKoltseg(raHet):
    end = datetime.date.today() + relativedelta(days=1)
    start = end + relativedelta(weeks =- raHet)
    results = szamlatetel.objects.filter(szamla__kelt__range=(start, end)) \
                                 .annotate(ev = ExtractYear('szamla__kelt'), het=ExtractWeek('szamla__kelt')) \
                                 .values('ev', 'het') \
                                 .annotate(db = Sum('brutto')) \
                                 .order_by('ev', 'het')
    return results

# Hónap vagy hét előnullázó
def datumVissza(raEv, raMasik):
    ev = str(raEv)
    masik = str(raMasik)
    if len(masik) == 1:
        masik = '0' + masik
    result = int(ev + masik)
    return result
