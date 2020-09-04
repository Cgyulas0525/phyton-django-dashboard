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

def tipus(request):
    context = {'type_list': types.objects.all()}
    return render(request, "tipus.html", context)

def tipus_delete(request, id):
    tipus = types.objects.get(pk=id)
    tipus.delete()
    return redirect('tipus')

def tipus_form(request, id=0):
    if request.method == "GET":
        if id == 0:
            form = tipusForm()
        else:
            tipus = types.objects.get(pk=id)
            form = tipusForm(instance=tipus)
        return render( request, "tipus_form.html",{'form':form})
    else:
        if id == 0:
            form = tipusForm(request.POST)
        else:
            tipus = types.objects.get(pk=id)
            form = tipusForm(request.POST, instance=tipus)
        if form.is_valid():
            form.save()
        return redirect('tipus')

def tipus_asJson(request):
    object_list = types.objects.all() #or any kind of queryset
    json = serializers.serialize('json', object_list)
    return HttpResponse(json, content_type='application/json')
