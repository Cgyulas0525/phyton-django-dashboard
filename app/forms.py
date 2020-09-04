from django import forms
from bootstrap_datepicker_plus import DatePickerInput
from .models import *
import datetime

class DateInput(forms.DateInput):
    input_type = 'date'

class tipusForm(forms.ModelForm):

    class Meta:
        model = types
        fields = ('nev', 'leiras')
        labels = {
            'nev':'Név',
            'leiras':'Leírás'
        }

    def __init__(self, *args, **kwargs):
        super(tipusForm, self).__init__(*args, **kwargs)
        self.fields['nev'].required = True
        self.fields['leiras'].required = False

class feladatForm(forms.ModelForm):

    class Meta:
        model = feladat
        fields = ('mit', 'mikorra', 'vege', 'megjegyzes')
        widgets = {
            'mikorra':DateInput,
            'vege':DateInput,
        }
        labels = {
            'mit':'Feladat',
            'mikorra':'Mikorra',
            'vege':'Teljesítés',
            'megjegyzes':'Megjegyzés'
        }

    def __init__(self, *args, **kwargs):
        super(feladatForm, self).__init__(*args, **kwargs)
        self.fields['mit'].required = True
        self.fields['mikorra'].required = True
        self.fields['mikorra'].initial=datetime.date.today
        self.fields['vege'].required = False
        self.fields['vege'].widget.attrs['readonly'] = True
        self.fields['megjegyzes'].required = False

class feladatVegeForm(forms.ModelForm):

    class Meta:
        model = feladat
        fields = ('mit', 'mikorra', 'vege', 'megjegyzes')
        widgets = {
            'mikorra':DateInput,
            'vege':DateInput,
        }
        labels = {
            'mit':'Feladat',
            'mikorra':'Mikorra',
            'vege':'Teljesítés',
            'megjegyzes':'Megjegyzés'
        }

    def __init__(self, *args, **kwargs):
        super(feladatVegeForm, self).__init__(*args, **kwargs)
        self.fields['mit'].widget.attrs['readonly'] = True
        self.fields['mikorra'].widget.attrs['readonly'] = True
        self.fields['megjegyzes'].widget.attrs['readonly'] = True
        self.fields['vege'].required = True
        self.fields['vege'].initial=datetime.date.today
