from django.contrib.auth.decorators import login_required
from django.shortcuts import render, get_object_or_404, redirect
from django.template import loader
from django.http import HttpResponse
from django.core import serializers
from django import template
from bootstrap_datepicker_plus import DateTimePickerInput
from django.db.models import *
from app.models import *
from app.forms import *
from app.util import *

def feladat_list(request):
    context = {'feladat_list': feladat.objects.all()}
    return render(request, "feladat.html", context)

def feladat_form(request, id=0):
    if request.method == "GET":
        if id == 0:
            form = feladatForm()
        else:
            elem = feladat.objects.get(pk=id)
            form = feladatForm(instance=elem)
        return render( request, "feladat_form.html",{'form':form})
    else:
        if id == 0:
            form = feladatForm(request.POST)
        else:
            elem = feladat.objects.get(pk=id)
            form = feladatForm(request.POST, instance=elem)
        if form.is_valid():
            form.save()
        return redirect('feladat')

def feladat_vegeform(request, id=0):
    if request.method == "GET":
        if id == 0:
            form = feladatForm()
        else:
            elem = feladat.objects.get(pk=id)
            elem.vege = datetime.date.today
            form = feladatVegeForm(instance=elem)
        return render( request, "feladat_form.html",{'form':form})
    else:
        if id == 0:
            form = feladatForm(request.POST)
        else:
            elem = feladat.objects.get(pk=id)
            form = feladatForm(request.POST, instance=elem)
        if form.is_valid():
            form.save()
        return redirect('feladat')

def feladat_delete(request, id):
    elem = feladat.objects.get(pk=id)
    elem.delete()
    return redirect('feladat')
