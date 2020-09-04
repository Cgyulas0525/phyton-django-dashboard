# -*- encoding: utf-8 -*-
"""
Copyright (c) 2019 - present AppSeed.us
"""

from django.urls import path, re_path
from app import views
from core import feladatviews
from core import tipusviews

urlpatterns = [

    # The home page
    path('', views.index, name='home'),
    path('index', views.index, name='index'),

    path('tipus', tipusviews.tipus, name='tipus'),
    path('insert/', tipusviews.tipus_form, name='tipus_insert'),
    path('insert/<int:id>/', tipusviews.tipus_form, name='tipus_update'),
    path('delete/<int:id>/', tipusviews.tipus_delete, name='tipus_delete'),

    path('feladat', feladatviews.feladat_list, name='feladat'),
    path('feladat/insert/', feladatviews.feladat_form, name='feladat_insert'),
    path('feladat/insert/<int:id>/', feladatviews.feladat_form, name='feladat_update'),
    path('feladat/delete/<int:id>/', feladatviews.feladat_delete, name='feladat_delete'),
    path('feladat/vege/<int:id>/', feladatviews.feladat_vegeform, name='feladat_vege'),

    # Matches any html file
#    re_path(r'^.*\.*', views.pages, name='pages'),

]
