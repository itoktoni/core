import './bootstrap';

import Swal from 'sweetalert2'

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import ajax from '@imacrayon/alpine-ajax';

Alpine.plugin(ajax)

Livewire.start()
