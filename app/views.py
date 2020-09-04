# -*- encoding: utf-8 -*-
"""
Copyright (c) 2019 - present AppSeed.us
"""

from django.contrib.auth.decorators import login_required
from django.shortcuts import render, get_object_or_404, redirect
from django.template import loader
from django.http import HttpResponse
from django.core import serializers
from django import template
from bootstrap_datepicker_plus import DateTimePickerInput
from django.db.models import *
from .models import *
from .forms import *
from .util import *
import json

@login_required(login_url="/login/")
def index(request):
    partnerek = partner.objects.count()
    termekek = termek.objects.count()
    tcsoport = termekcsoport.objects.count()
    tfocsoport = termekfocsoport.objects.count()
    koltseg = OsszKoltseg()
    arbevetel = 0
    evho = getEvHonapKoltseg(3)
    evhet = getEvHetKoltseg(12)

    categories = list()
    data = list()
    for entry in evhet:
        categories.append(datumVissza(entry['ev'], entry['het']))
        data.append(int(entry['db']))

    categoriesHonap = list()
    dataHonap = list()
    for entry in evho:
        categoriesHonap.append(datumVissza(entry['ev'], entry['honap']))
        dataHonap.append(int(entry['db']))


    context = {
        'partnerek': partnerek,
        'koltseg': koltseg,
        'arbevetel': arbevetel,
        'egyenleg': (arbevetel - koltseg),
        'termekek': termekek,
        'tcsoport': tcsoport,
        'tfocsoport': tfocsoport,
        'categories': json.dumps(categories),
        'data': json.dumps(data),
        'categoriesHonap': json.dumps(categoriesHonap),
        'dataHonap': json.dumps(dataHonap),
    }
    return render(request, "index.html", context)

@login_required(login_url="/login/")
def pages(request):
    context = {}
    # All resource paths end in .html.
    # Pick out the html file name from the url. And load that template.
    try:

        load_template = request.path.split('/')[-1]
        html_template = loader.get_template( load_template )
        if load_template == 'tipus.html':
            context = {'type_list': types.objects.all()}
        elif load_template == 'tipus_form.html':
            form = tipusForm(request.POST)
            if form.is_valid():
                form.save()
            return render( request, "tipus_form.html",{'form':form})
        return HttpResponse(html_template.render(context, request))

    except template.TemplateDoesNotExist:

        html_template = loader.get_template( 'page-404.html' )
        return HttpResponse(html_template.render(context, request))

    except:

        html_template = loader.get_template( 'page-500.html' )
        return HttpResponse(html_template.render(context, request))
