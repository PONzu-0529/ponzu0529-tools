// Model
import { ViewModelTestBase } from '@/tests/viewModels/ViewModelTestBase'
import { VocaloidMusicModel } from '@/models/VocaloidMusicModel'

// ViewModel
import NiconicoCustomMylistViewModel from '@/viewModels/NiconicoCustomMylistViewModel'


class NiconicoCustomMylistViewModelTest extends ViewModelTestBase {
  public static async getMusicListTest(): Promise<Array<VocaloidMusicModel>> {
    const niconicoCustomMylistViewModel = new NiconicoCustomMylistViewModel()
    await niconicoCustomMylistViewModel.setMusicList()
    return niconicoCustomMylistViewModel.getMusicList()
  }
}

(async () => {
  console.log(await NiconicoCustomMylistViewModelTest.getMusicListTest())
}
)()
