import './bootstrap';

import ajax from '@imacrayon/alpine-ajax';

import Swal from 'sweetalert2'

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.plugin(ajax)

Livewire.start()
